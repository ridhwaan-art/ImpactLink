<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Events</h2>
                <p class="text-sm text-gray-600">Plan projects, allocate volunteers, and track event attendance.</p>
            </div>
            <a href="{{ route('events.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">New Event</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Project</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($events as $event)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $event->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $event->project?->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $event->event_date }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('events.show', $event) }}" class="text-indigo-600">View</a>
                                    <a href="{{ route('events.assign', $event) }}" class="ml-3 text-emerald-600">Assign</a>
                                    <a href="{{ route('events.edit', $event) }}" class="ml-3 text-amber-600">Edit</a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="ml-3 inline-block" onsubmit="return confirm('Delete event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $events->links() }}</div>
        </div>
    </div>
</x-app-layout>
