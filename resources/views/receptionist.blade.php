<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Receptionist Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Dashboard</a></li>
                        <li><a href="#" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Check-In</a></li>
                        <li><a href="#" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Walk-In Registration</a></li>
                        <li><a href="#" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Lookup</a></li>
                        <li><a href="#" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a></li>
                    </ul>
                </div>
                <!-- Main Content -->
                <div class="w-3/4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
