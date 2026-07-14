<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">{{ $project->title }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-600">{{ $project->description }}</p>
            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    <p class="mt-1 text-gray-900">{{ $project->status }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Dates</p>
                    <p class="mt-1 text-gray-900">{{ $project->start_date }} to {{ $project->end_date }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
