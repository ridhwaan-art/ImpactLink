<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">{{ $event->title }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Project</p>
                        <p class="mt-1 text-gray-900">{{ $event->project?->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Location</p>
                        <p class="mt-1 text-gray-900">{{ $event->location }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Maximum Volunteers</p>
                        <p class="mt-1 text-gray-900">{{ $event->maximum_volunteers }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">QR Token</p>
                        <p class="mt-1 text-gray-900">{{ $event->qr_token }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">Generate Certificates for Present Attendees</h3>
                <p class="mt-1 text-sm text-gray-600">Certificates will be created only for volunteers marked as present for this event.</p>

                <form method="POST" action="{{ route('events.certificates.generate', $event) }}" class="mt-4 flex items-center gap-3">
                    @csrf
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="regenerate" value="1" />
                        Regenerate existing certificates
                    </label>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Generate Certificates</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
