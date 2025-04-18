<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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
                            <a href="{{ route('admin.visitor.logs') }}" class="block px-4 py-2 bg-white rounded">Visitor Logs</a>
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
                            <a href="{{ route('admin.notifications') }}" class="block px-4 py-2 bg-white rounded">Notifications</a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="{{ route('admin.analytics') }}" class="block px-4 py-2 bg-white rounded">Reports & Analytics</a>
                        </li>
                    </ul>
                </div>

                <div class="w-3/4 pl-4">
                    <div class="flex space-x-4 mb-6">
                        <!-- Total Users -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold">Total Users</h3>
                                <p class="text-3xl font-bold text-blue-500">{{ $users->count() }}</p>
                            </div>
                        </div>

                        <!-- Total Appointments -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold">Total Appointments</h3>
                                <p class="text-3xl font-bold text-green-500">{{ $appointments->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <a href="{{ route('admin.users.add') }}" class="px-4 py-2 bg-green-500 text-black rounded-lg hover:bg-green-600">
                            Add an Account
                        </a>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
