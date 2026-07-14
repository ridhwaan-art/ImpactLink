<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Edit Event</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <form action="{{ route('events.update', $event) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ $event->title }}" required class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" class="mt-1 w-full rounded-lg border-gray-300">{{ $event->description }}</textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Event Date</label>
                        <input type="date" name="event_date" value="{{ $event->event_date }}" required class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ $event->location }}" class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="text" name="start_time" value="{{ $event->start_time }}" class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="text" name="end_time" value="{{ $event->end_time }}" class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Maximum Volunteers</label>
                        <input type="number" name="maximum_volunteers" value="{{ $event->maximum_volunteers }}" class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-lg border-gray-300">
                        <option value="Scheduled" @selected($event->status === 'Scheduled')>Scheduled</option>
                        <option value="Completed" @selected($event->status === 'Completed')>Completed</option>
                        <option value="Cancelled" @selected($event->status === 'Cancelled')>Cancelled</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('events.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Cancel</a>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
