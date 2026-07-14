<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Organizations</h2>
                <p class="text-sm text-gray-600">Manage partner organizations in the ImpactLink Malawi network.</p>
            </div>
            <a href="{{ route('organizations.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">New Organization</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <form method="GET" class="flex gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search organizations" class="w-full rounded-lg border-gray-300" />
                    <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white">Search</button>
                </form>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($organizations as $organization)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $organization->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $organization->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $organization->phone }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('organizations.show', $organization) }}" class="text-indigo-600">View</a>
                                    <a href="{{ route('organizations.edit', $organization) }}" class="ml-3 text-amber-600">Edit</a>
                                    <form action="{{ route('organizations.destroy', $organization) }}" method="POST" class="ml-3 inline-block" onsubmit="return confirm('Delete organization?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No organizations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
