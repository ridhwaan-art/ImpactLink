<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Search Results</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('search') }}" class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <input type="text" name="q" value="{{ $term ?? '' }}" placeholder="Search volunteers, projects, events, organizations" class="w-full rounded-lg border-gray-300" />
            </form>

            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                @foreach(['volunteers' => 'Volunteers', 'projects' => 'Projects', 'events' => 'Events', 'organizations' => 'Organizations'] as $key => $label)
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $label }}</h3>
                        <div class="mt-4 space-y-2">
                            @forelse($results[$key] ?? [] as $item)
                                <div class="rounded-lg bg-gray-50 p-3 text-sm text-gray-700">{{ $item->name ?? ($item->first_name . ' ' . $item->last_name) ?? $item->title }}</div>
                            @empty
                                <p class="text-sm text-gray-500">No results.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
