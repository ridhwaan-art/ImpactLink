<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Volunteers</h2>
                <p class="text-sm text-gray-600">Tracking volunteers, participation, and community engagement.</p>
            </div>
            <a href="{{ route('volunteers.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Add Volunteer</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <form method="GET" class="grid gap-3 md:grid-cols-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search volunteers" class="rounded-lg border-gray-300" />
                    <select name="gender" class="rounded-lg border-gray-300">
                        <option value="">All genders</option>
                        <option value="Male" @selected(request('gender') === 'Male')>Male</option>
                        <option value="Female" @selected(request('gender') === 'Female')>Female</option>
                        <option value="Other" @selected(request('gender') === 'Other')>Other</option>
                    </select>
                    <select name="status" class="rounded-lg border-gray-300">
                        <option value="">All statuses</option>
                        <option value="Active" @selected(request('status') === 'Active')>Active</option>
                        <option value="Inactive" @selected(request('status') === 'Inactive')>Inactive</option>
                        <option value="Suspended" @selected(request('status') === 'Suspended')>Suspended</option>
                    </select>
                    <select name="volunteer_type" class="rounded-lg border-gray-300">
                        <option value="">All types</option>
                        <option value="Student" @selected(request('volunteer_type') === 'Student')>Student</option>
                        <option value="Community Member" @selected(request('volunteer_type') === 'Community Member')>Community Member</option>
                    </select>
                    <div class="md:col-span-4 flex justify-end">
                        <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white">Filter</button>
                    </div>
                </form>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Type</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($volunteers as $volunteer)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $volunteer->volunteer_type }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $volunteer->status }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('volunteers.show', $volunteer) }}" class="text-indigo-600">View</a>
                                    <a href="{{ route('volunteers.edit', $volunteer) }}" class="ml-3 text-amber-600">Edit</a>
                                    <form action="{{ route('volunteers.destroy', $volunteer) }}" method="POST" class="ml-3 inline-block" onsubmit="return confirm('Delete volunteer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No volunteers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $volunteers->links() }}</div>
        </div>
    </div>
</x-app-layout>
