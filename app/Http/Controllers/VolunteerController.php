<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVolunteerRequest;
use App\Http\Requests\UpdateVolunteerRequest;
use App\Models\Organization;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Volunteer::query();

        if ($user->role !== 'super_admin') {
            $query->where('organization_id', $user->organization_id);
        }

        $query->when($request->filled('search'), fn ($q) => $q->where('first_name', 'like', '%'.$request->search.'%')->orWhere('last_name', 'like', '%'.$request->search.'%'))
            ->when($request->filled('gender'), fn ($q) => $q->where('gender', $request->gender))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('volunteer_type'), fn ($q) => $q->where('volunteer_type', $request->volunteer_type));

        $volunteers = $query->latest()->paginate(10);

        $organizations = Organization::all();

        return view('volunteers.index', compact('volunteers', 'organizations'));
    }

    public function create(Request $request)
    {
        $organizations = $request->user()->role === 'super_admin' ? Organization::all() : collect();

        return view('volunteers.create', compact('organizations'));
    }

    public function store(StoreVolunteerRequest $request)
    {
        $data = $request->validated();
        $data['organization_id'] = $request->user()->role === 'super_admin' ? $data['organization_id'] : $request->user()->organization_id;
        $data['qr_code'] = Str::uuid();

        Volunteer::create($data);

        return redirect()->route('volunteers.index')->with('success', 'Volunteer created.');
    }

    public function show(Volunteer $volunteer)
    {
        return view('volunteers.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        return view('volunteers.edit', compact('volunteer'));
    }

    public function update(UpdateVolunteerRequest $request, Volunteer $volunteer)
    {
        $data = $request->validated();
        $volunteer->update($data);

        return redirect()->route('volunteers.index')->with('success', 'Volunteer updated.');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return redirect()->route('volunteers.index')->with('success', 'Volunteer deleted.');
    }
}
