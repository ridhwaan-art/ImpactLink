<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Edit Volunteer</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <form action="{{ route('volunteers.update', $volunteer) }}" method="POST" class="grid gap-4 md:grid-cols-2">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" value="{{ $volunteer->first_name }}" required class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" value="{{ $volunteer->last_name }}" required class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" class="mt-1 w-full rounded-lg border-gray-300">
                        <option value="Male" @selected($volunteer->gender === 'Male')>Male</option>
                        <option value="Female" @selected($volunteer->gender === 'Female')>Female</option>
                        <option value="Other" @selected($volunteer->gender === 'Other')>Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Age Range</label>
                    <input type="text" name="age_range" value="{{ $volunteer->age_range }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" value="{{ $volunteer->phone }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $volunteer->email }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="{{ $volunteer->location }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Volunteer Type</label>
                    <select name="volunteer_type" class="mt-1 w-full rounded-lg border-gray-300">
                        <option value="Student" @selected($volunteer->volunteer_type === 'Student')>Student</option>
                        <option value="Community Member" @selected($volunteer->volunteer_type === 'Community Member')>Community Member</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Institution / Area Name</label>
                    <input type="text" name="institution_name" value="{{ $volunteer->institution_name }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-lg border-gray-300">
                        <option value="Active" @selected($volunteer->status === 'Active')>Active</option>
                        <option value="Inactive" @selected($volunteer->status === 'Inactive')>Inactive</option>
                        <option value="Suspended" @selected($volunteer->status === 'Suspended')>Suspended</option>
                    </select>
                </div>
                <div class="md:col-span-2 flex justify-end gap-3">
                    <a href="{{ route('volunteers.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Cancel</a>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
