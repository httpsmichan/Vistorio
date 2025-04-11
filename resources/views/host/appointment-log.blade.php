<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                    <li><a href="{{ route('manage.appointments') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Manage Appointments</a></li>
                    <li><a href="{{ route('host.calendar') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Calendar</a></li>
                    <li><a href="{{ route('appointment.logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Logs</a></li>
                    <li><a href="{{ route('host.visitor-logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Logs</a></li>
                    <li><a href="#" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Profile Settings</a></li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="w-3/4 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Appointment Logs</h3>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Visitor Name, Status, or Booked Date..." oninput="searchLogs()">
                    </div>

                    <!-- Buttons to toggle between booked and completed logs -->
                    <div class="mb-4">
                        <button id="bookedLogsBtn" class="bg-transparent text-black px-4 py-2 rounded mr-4" onclick="toggleLogs('booked')">Booked Logs</button>
                        <button id="completedLogsBtn" class="bg-transparent text-black px-4 py-2 rounded" onclick="toggleLogs('completed')">Completed Logs</button>
                    </div>

                    <!-- Booked Logs Section -->
                    <div id="bookedLogs" class="space-y-6 hidden appointment-log-container">
                        @if($bookedAppointments->isEmpty())
                            <p class="text-gray-600">No bookings yet.</p> <!-- Default message if no booked appointments -->
                        @else
                            @foreach($bookedAppointments as $appointment)
                                <div class="p-4 mb-2 border-b appointment-log" data-name="{{ $appointment->name }}" data-status="{{ $appointment->status }}" data-booked-date="{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}">
                                    <p><strong>{{ $appointment->name }}</strong> has booked an appointment on {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}.</p>
                                    <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y h:i A') }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Completed Logs Section -->
                    <div id="completedLogs" class="space-y-6 hidden appointment-log-container">
                        @foreach($completedAppointments as $appointment)
                            <div class="p-4 mb-2 border-b appointment-log" data-name="{{ $appointment->name }}" data-status="{{ $appointment->status }}" data-booked-date="{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}">
                                <p><strong>{{ $appointment->name }}</strong> has completed an appointment on {{ \Carbon\Carbon::parse($appointment->updated_at)->format('M d, Y h:i A') }}.</p>
                                <p><strong>Booked On:</strong> {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle between booked and completed logs
        function toggleLogs(type) {
            document.getElementById('bookedLogs').classList.add('hidden');
            document.getElementById('completedLogs').classList.add('hidden');

            if (type === 'booked') {
                document.getElementById('bookedLogs').classList.remove('hidden');
            } else {
                document.getElementById('completedLogs').classList.remove('hidden');
            }
        }

        // Set default view to show booked logs
        window.onload = function() {
            toggleLogs('booked');
        }

        // Search function
        function searchLogs() {
            const query = document.getElementById('searchBar').value.toLowerCase();
            const logs = document.querySelectorAll('.appointment-log');

            logs.forEach(log => {
                const name = log.getAttribute('data-name').toLowerCase();
                const status = log.getAttribute('data-status').toLowerCase();
                const bookedDate = log.getAttribute('data-booked-date').toLowerCase();

                if (name.includes(query) || status.includes(query) || bookedDate.includes(query)) {
                    log.style.display = '';
                } else {
                    log.style.display = 'none';
                }
            });
        }
    </script>

</x-app-layout>
