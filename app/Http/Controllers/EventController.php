<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Project;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();
        if ($request->user()->role !== 'super_admin') {
            $query->where('organization_id', $request->user()->organization_id);
        }

        $events = $query->with('project')->latest()->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create(Request $request)
    {
        $projects = $request->user()->role === 'super_admin' ? Project::all() : Project::where('organization_id', $request->user()->organization_id)->get();

        return view('events.create', compact('projects'));
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $data['organization_id'] = $request->user()->role === 'super_admin' ? $data['organization_id'] : $request->user()->organization_id;
        $data['qr_token'] = Str::uuid();

        $event = Event::create($data);

        return redirect()->route('events.index')->with('success', 'Event created.');
    }

    public function show(Event $event)
    {
        $event->load('project', 'volunteers');

        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }

    public function assignVolunteers(Request $request, Event $event)
    {
        $availableVolunteers = Volunteer::where('organization_id', $event->organization_id)->whereDoesntHave('events', function ($q) use ($event) {
            $q->where('event_id', $event->id);
        })->get();

        $assignedVolunteers = $event->volunteers;

        return view('events.assign', compact('event', 'availableVolunteers', 'assignedVolunteers'));
    }

    public function attachVolunteers(Request $request, Event $event)
    {
        $selected = $request->input('volunteer_ids', []);
        $event->volunteers()->sync($selected);

        return redirect()->route('events.show', $event)->with('success', 'Volunteers assigned.');
    }
}
