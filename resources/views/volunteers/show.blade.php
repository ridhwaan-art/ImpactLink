<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-medium text-gray-500">Email</p>
                    <p class="mt-1 text-gray-900">{{ $volunteer->email }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Phone</p>
                    <p class="mt-1 text-gray-900">{{ $volunteer->phone }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Volunteer Type</p>
                    <p class="mt-1 text-gray-900">{{ $volunteer->volunteer_type }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    <p class="mt-1 text-gray-900">{{ $volunteer->status }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">QR Code</p>
                    <p class="mt-1 text-gray-900">{{ $volunteer->qr_code }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Location</p>
                    <p class="mt-1 text-gray-900">{{ $volunteer->location }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
