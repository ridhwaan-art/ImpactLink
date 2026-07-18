<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Certificates</h2>
                <p class="text-sm text-gray-600">Manage and review volunteer certificates.</p>
            </div>
            <a href="{{ route('certificates.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Generate Certificate</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
            <form method="GET" class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="grid gap-4 md:grid-cols-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by certificate or volunteer" class="rounded-lg border-gray-300" />
                    <select name="project_id" class="rounded-lg border-gray-300">
                        <option value="">All projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" @selected(request('project_id') == $project->id)>{{ $project->title }}</option>
                        @endforeach
                    </select>
                    <select name="volunteer_id" class="rounded-lg border-gray-300">
                        <option value="">All volunteers</option>
                        @foreach($volunteers as $volunteer)
                            <option value="{{ $volunteer->id }}" @selected(request('volunteer_id') == $volunteer->id)>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="rounded-lg border-gray-300">
                        <option value="">All statuses</option>
                        <option value="Issued" @selected(request('status') === 'Issued')>Issued</option>
                        <option value="Pending" @selected(request('status') === 'Pending')>Pending</option>
                    </select>
                </div>
                <div class="mt-4 flex gap-3">
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Filter</button>
                    <a href="{{ route('certificates.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Reset</a>
                </div>
            </form>

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Certificate</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Volunteer</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Project</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Event</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Issued</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($certificates as $certificate)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $certificate->certificate_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->volunteer?->first_name }} {{ $certificate->volunteer?->last_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->project?->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->event?->title ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->issue_date }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $certificate->status }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('certificates.show', $certificate) }}" target="_blank" class="rounded bg-blue-600 px-2 py-1 text-white">View</a>
                                        <a href="{{ route('certificates.download', $certificate) }}" class="rounded bg-green-600 px-2 py-1 text-white">Download</a>
                                        <form method="POST" action="{{ route('certificates.regenerate', $certificate) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="rounded bg-amber-600 px-2 py-1 text-white">Regenerate</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">No certificates found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="border-t border-gray-200 px-4 py-3">
                    {{ $certificates->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
