<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" name="name" id="name" class="border p-2 w-full" value="{{ old('name', $employee->name) }}" required>
                    </div>

                    <!-- Position -->
                    <div class="mb-4">
                        <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                        <input type="text" name="position" id="position" class="border p-2 w-full" value="{{ old('position', $employee->position) }}" required>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update
                        </button>
                        <a href="{{ route('admin.employees') }}" class="text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
