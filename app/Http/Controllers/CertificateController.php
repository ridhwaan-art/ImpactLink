<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\Project;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::query()->with(['volunteer', 'project', 'event', 'generatedBy'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('certificate_number', 'like', "%{$search}%")
                    ->orWhereHas('volunteer', function ($volunteerQuery) use ($search) {
                        $volunteerQuery->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('project', function ($projectQuery) use ($search) {
                        $projectQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('volunteer_id')) {
            $query->where('volunteer_id', $request->volunteer_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $certificates = $query->paginate(10)->appends($request->query());
        $projects = Project::all();
        $volunteers = Volunteer::all();

        return view('certificates.index', compact('certificates', 'projects', 'volunteers'));
    }

    public function create(Request $request)
    {
        $volunteers = $this->scopeToUser($request, Volunteer::query())->get();
        $projects = $this->scopeToUser($request, Project::query())->get();
        $events = $this->scopeToUser($request, Event::query())->get();

        return view('certificates.create', compact('volunteers', 'projects', 'events'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'event_id' => ['nullable', 'exists:events,id'],
            'hours' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string', 'max:1000'],
            'regenerate' => ['nullable', 'boolean'],
        ]);

        $volunteer = Volunteer::findOrFail($data['volunteer_id']);
        $project = Project::findOrFail($data['project_id']);

        $existing = Certificate::where('volunteer_id', $volunteer->id)
            ->where('project_id', $project->id)
            ->when(! empty($data['event_id']), fn ($query) => $query->where('event_id', $data['event_id']))
            ->first();

        if ($existing && ! $request->boolean('regenerate')) {
            return back()->withErrors(['certificate' => 'A certificate already exists for this volunteer and selection. Choose regenerate to create a new version.'])->withInput();
        }

        if ($existing && $request->boolean('regenerate')) {
            $existing->delete();
        }

        try {
            $certificate = $this->createCertificate($request->user(), $volunteer, $project, $data['event_id'] ?? null, $data['hours'] ?? null, $data['description'] ?? null);

            return redirect()->route('certificates.index')->with('success', 'Certificate generated successfully.');
        } catch (\Throwable $exception) {
            Log::error('Certificate generation failed', ['exception' => $exception->getMessage()]);

            return back()->withErrors(['certificate' => 'Certificate generation failed. Please try again.'])->withInput();
        }
    }

    public function show(Certificate $certificate)
    {
        $path = storage_path('app/public/'.$certificate->pdf_path);

        if (! file_exists($path)) {
            return redirect()->route('certificates.index')->withErrors(['certificate' => 'The PDF file is not available yet.']);
        }

        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }

    public function download(Certificate $certificate)
    {
        $path = storage_path('app/public/'.$certificate->pdf_path);

        if (! file_exists($path)) {
            return redirect()->route('certificates.index')->withErrors(['certificate' => 'The PDF file is not available yet.']);
        }

        return response()->download($path, 'certificate-'.$certificate->certificate_number.'.pdf');
    }

    public function verify(Request $request, string $token)
    {
        $certificate = Certificate::where('verification_token', $token)->first();

        return view('certificates.verify', compact('certificate'));
    }

    public function regenerate(Certificate $certificate)
    {
        try {
            $certificate->delete();
            $this->createCertificate(auth()->user(), $certificate->volunteer, $certificate->project, $certificate->event_id, $certificate->hours, $certificate->description);

            return back()->with('success', 'Certificate regenerated successfully.');
        } catch (\Throwable $exception) {
            Log::error('Certificate regeneration failed', ['exception' => $exception->getMessage()]);

            return back()->withErrors(['certificate' => 'Certificate regeneration failed. Please try again.']);
        }
    }

    public function generateForVolunteer(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'event_id' => ['nullable', 'exists:events,id'],
            'hours' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string', 'max:1000'],
            'regenerate' => ['nullable', 'boolean'],
        ]);

        $project = Project::findOrFail($data['project_id']);
        $existing = Certificate::where('volunteer_id', $volunteer->id)
            ->where('project_id', $project->id)
            ->when(! empty($data['event_id']), fn ($query) => $query->where('event_id', $data['event_id']))
            ->first();

        if ($existing && ! $request->boolean('regenerate')) {
            return back()->withErrors(['certificate' => 'A certificate already exists for this volunteer and selection.'])->withInput();
        }

        if ($existing && $request->boolean('regenerate')) {
            $existing->delete();
        }

        try {
            $this->createCertificate($request->user(), $volunteer, $project, $data['event_id'] ?? null, $data['hours'] ?? null, $data['description'] ?? null);

            return back()->with('success', 'Certificate generated successfully.');
        } catch (\Throwable $exception) {
            Log::error('Volunteer certificate generation failed', ['exception' => $exception->getMessage()]);

            return back()->withErrors(['certificate' => 'Certificate generation failed. Please try again.']);
        }
    }

    public function generateForEvent(Request $request, Event $event)
    {
        $data = $request->validate([
            'regenerate' => ['nullable', 'boolean'],
        ]);

        $presentVolunteerIds = Attendance::where('event_id', $event->id)
            ->where('status', 'Present')
            ->pluck('volunteer_id');

        if ($presentVolunteerIds->isEmpty()) {
            return back()->withErrors(['certificate' => 'No present attendees were found for this event.']);
        }

        $generated = 0;

        foreach ($presentVolunteerIds as $volunteerId) {
            $volunteer = Volunteer::find($volunteerId);
            if (! $volunteer) {
                continue;
            }

            $existing = Certificate::where('volunteer_id', $volunteer->id)
                ->where('project_id', $event->project_id)
                ->where('event_id', $event->id)
                ->first();

            if ($existing && ! $request->boolean('regenerate')) {
                continue;
            }

            if ($existing && $request->boolean('regenerate')) {
                $existing->delete();
            }

            $this->createCertificate($request->user(), $volunteer, $event->project, $event->id, null, 'Recognized for participation in '.$event->title.'.');
            $generated++;
        }

        return back()->with('success', 'Generated '.$generated.' certificate(s) for present attendees.');
    }

    private function createCertificate($user, Volunteer $volunteer, Project $project, ?int $eventId, ?int $hours, ?string $description): Certificate
    {
        $certificate = Certificate::create([
            'certificate_number' => $this->generateCertificateNumber(),
            'volunteer_id' => $volunteer->id,
            'project_id' => $project->id,
            'event_id' => $eventId,
            'hours' => $hours,
            'issue_date' => now()->toDateString(),
            'pdf_path' => null,
            'generated_by' => $user?->id,
            'status' => 'Issued',
            'verification_token' => (string) Str::uuid(),
            'description' => $description ?: 'Recognized for meaningful participation and service.',
        ]);

        Storage::disk('public')->makeDirectory('certificates');

        $pdf = Pdf::loadView('certificates.pdf', ['certificate' => $certificate->load(['volunteer.organization', 'project', 'event'])]);
        $pdf->setPaper('a4', 'portrait');
        $path = 'certificates/'.$certificate->id.'.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        $certificate->update(['pdf_path' => $path]);

        return $certificate;
    }

    private function generateCertificateNumber(): string
    {
        do {
            $number = 'IML-'.strtoupper(Str::random(6));
        } while (Certificate::where('certificate_number', $number)->exists());

        return $number;
    }

    private function scopeToUser(Request $request, $query)
    {
        if ($request->user()?->role !== 'super_admin') {
            return $query->where('organization_id', $request->user()->organization_id);
        }

        return $query;
    }
}
