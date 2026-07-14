<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-900">ImpactLink Malawi Dashboard</h2>
                <p class="text-sm text-gray-600">A modern volunteer operations hub for community impact programs.</p>
            </div>
            <div class="rounded-full bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach([
                    ['label' => 'Organizations', 'value' => $stats['organizations'] ?? 0, 'tone' => 'indigo'],
                    ['label' => 'Volunteers', 'value' => $stats['volunteers'] ?? 0, 'tone' => 'emerald'],
                    ['label' => 'Active Volunteers', 'value' => $stats['active_volunteers'] ?? 0, 'tone' => 'sky'],
                    ['label' => 'Projects', 'value' => $stats['projects'] ?? 0, 'tone' => 'amber'],
                    ['label' => 'Events', 'value' => $stats['events'] ?? 0, 'tone' => 'violet'],
                    ['label' => 'Certificates', 'value' => $stats['certificates'] ?? 0, 'tone' => 'rose'],
                ] as $card)
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">{{ $card['label'] }}</p>
                        <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $card['value'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Upcoming Events</h3>
                        <a href="{{ route('events.index') }}" class="text-sm font-medium text-indigo-600">Manage</a>
                    </div>
                    <div class="mt-4 space-y-3">
                        @forelse($upcomingEvents as $event)
                            <div class="flex items-center justify-between rounded-xl bg-gray-50 p-3">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $event->title }}</p>
                                    <p class="text-sm text-gray-600">{{ $event->project?->title }} • {{ $event->event_date }}</p>
                                </div>
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">{{ $event->status }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No events created yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <a href="{{ route('volunteers.index') }}" class="rounded-xl border border-gray-200 p-4 text-sm font-semibold text-gray-700 hover:bg-gray-50">Manage Volunteers</a>
                        <a href="{{ route('projects.index') }}" class="rounded-xl border border-gray-200 p-4 text-sm font-semibold text-gray-700 hover:bg-gray-50">Manage Projects</a>
                        <a href="{{ route('events.index') }}" class="rounded-xl border border-gray-200 p-4 text-sm font-semibold text-gray-700 hover:bg-gray-50">Schedule Events</a>
                        <a href="{{ route('certificates.index') }}" class="rounded-xl border border-gray-200 p-4 text-sm font-semibold text-gray-700 hover:bg-gray-50">Issue Certificates</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
