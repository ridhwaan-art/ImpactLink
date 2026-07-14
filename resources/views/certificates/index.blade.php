<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Certificates</h2>
                <p class="text-sm text-gray-600">Generate recognition for volunteer participation.</p>
            </div>
            <a href="{{ route('certificates.generate') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Generate Certificate</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Certificate</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Volunteer</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Project</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Issue Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($certificates as $certificate)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $certificate->certificate_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->volunteer?->first_name }} {{ $certificate->volunteer?->last_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->project?->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->issue_date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No certificates found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
