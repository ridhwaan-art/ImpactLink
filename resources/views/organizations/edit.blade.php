<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Edit Organization</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <form action="{{ route('organizations.update', $organization) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ $organization->name }}" required class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $organization->email }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" value="{{ $organization->phone }}" class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" class="mt-1 w-full rounded-lg border-gray-300">{{ $organization->address }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" name="logo" class="mt-1 w-full" />
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('organizations.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Cancel</a>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
