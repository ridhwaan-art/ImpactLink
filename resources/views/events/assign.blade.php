<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Assign Volunteers</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Event</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $event->title }}</p>
                </div>
                <div class="rounded-full bg-indigo-100 px-4 py-2 text-sm font-semibold text-indigo-700">{{ $event->maximum_volunteers }} max</div>
            </div>

            <form action="{{ route('events.attach', $event) }}" method="POST" class="mt-6">
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500">Available Volunteers</h3>
                        <div class="mt-3 space-y-2">
                            @foreach($availableVolunteers as $volunteer)
                                <label class="flex items-center justify-between rounded-lg border border-gray-200 p-3">
                                    <span>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</span>
                                    <input type="checkbox" name="volunteer_ids[]" value="{{ $volunteer->id }}" />
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500">Assigned Volunteers</h3>
                        <div class="mt-3 space-y-2">
                            @foreach($assignedVolunteers as $volunteer)
                                <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-800">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Save Assignment</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
