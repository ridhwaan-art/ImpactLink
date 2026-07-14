<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->can('viewAny', Organization::class);

        $organizations = Organization::query()
            ->when($request->filled('search'), fn ($query) => $query->where('name', 'like', '%'.$request->search.'%'))
            ->latest()
            ->paginate(10);

        return view('organizations.index', compact('organizations'));
    }

    public function create()
    {
        auth()->user()->can('create', Organization::class);

        return view('organizations.create');
    }

    public function store(StoreOrganizationRequest $request)
    {
        auth()->user()->can('create', Organization::class);

        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Organization::create($data);

        return redirect()->route('organizations.index')->with('success', 'Organization created.');
    }

    public function show(Organization $organization)
    {
        auth()->user()->can('view', $organization);

        return view('organizations.show', compact('organization'));
    }

    public function edit(Organization $organization)
    {
        auth()->user()->can('update', $organization);

        return view('organizations.edit', compact('organization'));
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        auth()->user()->can('update', $organization);

        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $organization->update($data);

        return redirect()->route('organizations.index')->with('success', 'Organization updated.');
    }

    public function destroy(Organization $organization)
    {
        auth()->user()->can('delete', $organization);

        if ($organization->logo) {
            Storage::disk('public')->delete($organization->logo);
        }
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted.');
    }
}
