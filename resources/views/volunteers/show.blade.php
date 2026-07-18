<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-gray-900">{{ $volunteer->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Phone</p>
                        <p class="mt-1 text-gray-900">{{ $volunteer->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Volunteer Type</p>
                        <p class="mt-1 text-gray-900">{{ $volunteer->volunteer_type }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <p class="mt-1 text-gray-900">{{ $volunteer->status }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">QR Code</p>
                        <p class="mt-1 text-gray-900">{{ $volunteer->qr_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Location</p>
                        <p class="mt-1 text-gray-900">{{ $volunteer->location }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Generate Certificate</h3>
                        <p class="text-sm text-gray-600">Create a PDF certificate for this volunteer.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('volunteers.certificates.store', $volunteer) }}" class="mt-6 space-y-4">
                    @csrf
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Project</label>
                            <select name="project_id" required class="w-full rounded-lg border-gray-300">
                                <option value="">Select a project</option>
                                @foreach($volunteer->organization?->projects ?? [] as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Event (optional)</label>
                            <select name="event_id" class="w-full rounded-lg border-gray-300">
                                <option value="">No event</option>
                                @foreach($volunteer->organization?->events ?? [] as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Hours</label>
                            <input type="number" name="hours" min="1" class="w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300"></textarea>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="regenerate" value="1" />
                            Regenerate existing certificate
                        </label>
                        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Generate Certificate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
