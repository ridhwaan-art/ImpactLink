<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Create Project</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" required class="mt-1 w-full rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" class="mt-1 w-full rounded-lg border-gray-300"></textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" required class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" class="mt-1 w-full rounded-lg border-gray-300" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-lg border-gray-300">
                        <option value="Planning">Planning</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('projects.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Cancel</a>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
