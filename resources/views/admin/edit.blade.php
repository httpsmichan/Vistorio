<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Edit User') }}</h3>

                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="role" name="role" class="w-full px-3 py-2 border rounded-lg">
                            <option value="visitor" {{ $user->role === 'visitor' ? 'selected' : '' }}>visitor</option>
                            <option value="host" {{ $user->role === 'host' ? 'selected' : '' }}>host</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="receptionist" {{ $user->role === 'receptionist' ? 'selected' : '' }}>receptionist</option>

                            </select>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-lg">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
