<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Account') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex space-x-4">

                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointments') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">
                                Appointments
                            </a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="#" class="block px-4 py-2 bg-white rounded">Visitor Logs</a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="#" class="block px-4 py-2 bg-white rounded">System Settings</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">
                                User Management
                            </a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="{{ route('admin.employees') }}" class="block px-4 py-2 bg-white rounded">Employee Management</a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="#" class="block px-4 py-2 bg-white rounded">Notifications</a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="#" class="block px-4 py-2 bg-white rounded">Reports & Analytics</a>
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
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

                            <button type="submit" class="px-4 py-2 bg-blue-500 text-black hover:bg-blue-600 rounded-lg transition">
                                Add Account
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
