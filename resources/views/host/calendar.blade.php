<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Calendar View') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex space-x-4">
            <!-- Sidebar -->
            <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
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
            <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                <!-- Search Bar -->
                <div class="mb-4">
                    <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Visitor Name, Status, or Booked Date..." oninput="searchLogs()">
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-4">
                    @foreach($groupedAppointments as $date => $appointments)
                        <div class="bg-white border rounded-lg shadow p-3 appointment-group" data-date="{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}">
                            <h3 class="font-bold text-md mb-2 text-blue-600">{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</h3>
                            @foreach($appointments as $appt)
                                <div class="border-b border-gray-200 py-1 mb-1 appointment-item" data-name="{{ $appt->name ?? 'Unknown Visitor' }}" data-status="{{ $appt->status }}">
                                    <p class="text-sm font-semibold">{{ $appt->name ?? 'Unknown Visitor' }}</p>
                                    <p class="text-xs text-gray-600">Appointment Time: {{ \Carbon\Carbon::parse($appt->preferred_date_time)->format('h:i A') }}</p>
                                    <p class="text-xs text-green-600 capitalize">{{ $appt->status }}</p>
                                    <p class="text-xs text-gray-500">{{ 'Host: ' . $appt->host }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchLogs() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let appointmentGroups = document.querySelectorAll('.appointment-group');
            
            appointmentGroups.forEach(group => {
                let groupDate = group.getAttribute('data-date').toLowerCase();
                let matched = false;

                let appointmentItems = group.querySelectorAll('.appointment-item');
                appointmentItems.forEach(item => {
                    let name = item.getAttribute('data-name').toLowerCase();
                    let status = item.getAttribute('data-status').toLowerCase();

                    if (name.includes(searchQuery) || status.includes(searchQuery) || groupDate.includes(searchQuery)) {
                        item.style.display = '';  // Show the matched item
                        matched = true;
                    } else {
                        item.style.display = 'none';  // Hide the unmatched item
                    }
                });

                // Show or hide the entire group if no appointments match the search
                if (matched) {
                    group.style.display = ''; // Show the group
                } else {
                    group.style.display = 'none'; // Hide the group
                }
            });
        }
    </script>
</x-app-layout>
