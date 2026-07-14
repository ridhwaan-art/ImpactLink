<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Project;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $certificates = Certificate::with(['volunteer', 'project'])->latest()->paginate(10);

        return view('certificates.index', compact('certificates'));
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'project_id' => ['required', 'exists:projects,id'],
        ]);

        $certificate = Certificate::create([
            'certificate_number' => 'IML-'.Str::upper(Str::random(6)),
            'volunteer_id' => $data['volunteer_id'],
            'project_id' => $data['project_id'],
            'issue_date' => now()->toDateString(),
            'pdf_path' => 'certificates/demo.pdf',
        ]);

        $pdf = Pdf::loadView('certificates.pdf', ['certificate' => $certificate]);
        $path = 'certificates/'.$certificate->id.'.pdf';
        $pdf->save(storage_path('app/public/'.$path));
        $certificate->update(['pdf_path' => $path]);

        return redirect()->route('certificates.index')->with('success', 'Certificate generated.');
    }
}
