<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with(['event', 'volunteer'])->latest()->paginate(10);

        return view('attendance.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
            'volunteer_id' => ['required', 'exists:volunteers,id'],
            'status' => ['required', 'in:Present,Absent,Late'],
        ]);

        Attendance::create($data + ['check_in_time' => now()]);

        return back()->with('success', 'Attendance recorded.');
    }

    public function scan(Request $request, string $token)
    {
        $event = Event::where('qr_token', $token)->firstOrFail();
        $volunteer = Volunteer::where('qr_code', $request->query('volunteer_qr'))->firstOrFail();

        Attendance::updateOrCreate(
            ['event_id' => $event->id, 'volunteer_id' => $volunteer->id],
            ['status' => 'Present', 'check_in_time' => now()]
        );

        return response()->json(['message' => 'Attendance recorded']);
    }
}
