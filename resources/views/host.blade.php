<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Host Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex space-x-4">
                <!-- Sidebar -->
                <div class="w-1/5 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('manage.appointments') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Manage Appointments</a></li>
                        <li><a href="{{ route('host.calendar') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Calendar</a></li>
                        <li><a href="{{ route('appointment.logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Logs</a></li>
                        <li><a href="{{ route('host.visitor-logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Logs</a></li>
                        <li><a href="{{ route('host.notifications') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a></li>
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
</x-app-layout>