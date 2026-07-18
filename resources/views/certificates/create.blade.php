<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Create Certificate</h2>
                <p class="text-sm text-gray-600">Generate a PDF certificate for a volunteer.</p>
            </div>
            <a href="{{ route('certificates.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Back</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('certificates.store') }}" class="space-y-5">
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Volunteer</label>
                        <select name="volunteer_id" required class="w-full rounded-lg border-gray-300">
                            <option value="">Select a volunteer</option>
                            @foreach($volunteers as $volunteer)
                                <option value="{{ $volunteer->id }}">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Project</label>
                        <select name="project_id" required class="w-full rounded-lg border-gray-300">
                            <option value="">Select a project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Event (optional)</label>
                        <select name="event_id" class="w-full rounded-lg border-gray-300">
                            <option value="">No event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Hours</label>
                        <input type="number" name="hours" min="1" class="w-full rounded-lg border-gray-300" />
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300"></textarea>
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
</x-app-layout>
