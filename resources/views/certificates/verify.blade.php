<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Certificate Verification</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            @if($certificate)
                <div class="space-y-3 text-sm text-gray-700">
                    <p><span class="font-semibold">Certificate Number:</span> {{ $certificate->certificate_number }}</p>
                    <p><span class="font-semibold">Volunteer:</span> {{ $certificate->volunteer?->first_name }} {{ $certificate->volunteer?->last_name }}</p>
                    <p><span class="font-semibold">Organization:</span> {{ $certificate->volunteer?->organization?->name }}</p>
                    <p><span class="font-semibold">Project:</span> {{ $certificate->project?->title }}</p>
                    <p><span class="font-semibold">Event:</span> {{ $certificate->event?->title ?? 'N/A' }}</p>
                    <p><span class="font-semibold">Issue Date:</span> {{ $certificate->issue_date }}</p>
                    <p><span class="font-semibold">Verification Status:</span> <span class="font-semibold text-green-600">Valid</span></p>
                </div>
            @else
                <p class="text-red-600">The provided certificate could not be verified.</p>
            @endif
        </div>
    </div>
</x-app-layout>
