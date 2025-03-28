<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Add New Account') }}</h3>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" required class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="role" name="role" required class="w-full px-3 py-2 border rounded-lg">
                                <option value="visitor">Visitor</option>
                                <option value="host">Host</option>
                                <option value="admin">Admin</option>
                                <option value="receptionist">Receptionist</option>
                            </select>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
