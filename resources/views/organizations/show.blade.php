<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">{{ $organization->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-medium text-gray-500">Email</p>
                    <p class="mt-1 text-gray-900">{{ $organization->email }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Phone</p>
                    <p class="mt-1 text-gray-900">{{ $organization->phone }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Address</p>
                    <p class="mt-1 text-gray-900">{{ $organization->address }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Members</p>
                    <p class="mt-1 text-gray-900">{{ $organization->users()->count() }} users • {{ $organization->volunteers()->count() }} volunteers</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
