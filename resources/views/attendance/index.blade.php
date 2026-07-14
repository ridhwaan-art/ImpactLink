<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Attendance</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Volunteer</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Event</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Checked In</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($attendances as $attendance)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $attendance->volunteer?->first_name }} {{ $attendance->volunteer?->last_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $attendance->event?->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $attendance->status }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $attendance->check_in_time }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
