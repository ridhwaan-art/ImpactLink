<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">{{ $event->title }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
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
    </div>
</x-app-layout>
