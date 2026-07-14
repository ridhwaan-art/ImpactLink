<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $organization = $request->user()->organization;

        if ($request->user()->role === 'super_admin') {
            $stats = [
                'organizations' => Organization::count(),
                'volunteers' => Volunteer::count(),
                'active_volunteers' => Volunteer::where('status', 'Active')->count(),
                'projects' => Project::count(),
                'events' => Event::count(),
                'certificates' => Certificate::count(),
            ];
        } else {
            $stats = [
                'organizations' => 1,
                'volunteers' => $organization?->volunteers()->count() ?? 0,
                'active_volunteers' => $organization?->volunteers()->where('status', 'Active')->count() ?? 0,
                'projects' => $organization?->projects()->count() ?? 0,
                'events' => $organization?->events()->count() ?? 0,
                'certificates' => Certificate::whereIn('volunteer_id', $organization?->volunteers()->pluck('id') ?? [])->count(),
            ];
        }

        $recentActivities = [];
        $upcomingEvents = Event::with('project')->orderBy('event_date')->take(5)->get();

        return view('dashboard', compact('stats', 'recentActivities', 'upcomingEvents'));
    }
}
