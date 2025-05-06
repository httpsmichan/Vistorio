<x-app-layout>
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
            <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Appointment Logs</h3>

                <!-- Filter by -->
                <div class="mb-4">
                    <form method="GET" action="{{ route('appointment.logs') }}" class="flex items-center space-x-4 justify-end">
                        <div>
                            <label for="filter_type" class="text-sm font-medium">Filter By:</label>
                            <select id="filter_type" name="filter_type" class="px-8 py-2 border rounded" onchange="toggleFilterInput()">
                                <option value="status" {{ request('filter_type') === 'status' ? 'selected' : '' }}>Status</option>
                                <option value="date" {{ request('filter_type') === 'date' ? 'selected' : '' }}>Date</option>
                            </select>
                        </div>

                        <!-- Status Dropdown -->
                        <div id="status_filter" style="{{ request('filter_type') === 'date' ? 'display:none;' : '' }}">
                            <label for="status" class="text-sm font-medium">Status:</label>
                            <select name="status" id="status" class="px-8 py-2 border rounded">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <!-- Date Picker -->
                        <div id="date_filter" style="{{ request('filter_type') === 'status' || !request('filter_type') ? 'display:none;' : '' }}">
                            <label for="date" class="text-sm font-medium">Date:</label>
                            <input type="date" name="date" id="date" value="{{ request('date') }}" class="px-3 py-2 border rounded">
                        </div>

                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Filter</button>
                        </div>
                    </form>
                </div>

                <!-- Search Bar -->
                <div class="mb-4">
                    <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Visitor Name..." oninput="searchLogs()">
                </div>

                <!-- Logs -->
                <div class="space-y-6 appointment-log-container">
                    @foreach($appointments as $appointment)
                        <div class="p-4 mb-2 border-b appointment-log"
                             data-name="{{ $appointment->name }}"
                             data-status="{{ $appointment->status }}"
                             data-booked-date="{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}"
                             data-appointment-date="{{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y h:i A') }}">

                            @if($appointment->status == 'completed')
                                <p><strong>{{ $appointment->name }}</strong> has completed an appointment on {{ \Carbon\Carbon::parse($appointment->updated_at)->format('M d, Y h:i A') }}.</p>
                            @else
                                <p><strong>{{ $appointment->name }}</strong> has booked an appointment on {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}.</p>
                            @endif
                            
                            <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y h:i A') }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <script>
        function toggleFilterInput() {
            const filterType = document.getElementById('filter_type').value;
            document.getElementById('status_filter').style.display = (filterType === 'status') ? 'block' : 'none';
            document.getElementById('date_filter').style.display = (filterType === 'date') ? 'block' : 'none';
        }

        window.onload = function() {
            toggleFilterInput();
            toggleLogs('booked');
        }

        function searchLogs() {
            const query = document.getElementById('searchBar').value.toLowerCase();
            const logs = document.querySelectorAll('.appointment-log');

            logs.forEach(log => {
                const name = log.getAttribute('data-name').toLowerCase();

                if (name.includes(query)) {
                    log.style.display = '';
                } else {
                    log.style.display = 'none';
                }
            });
        }
    </script>

</x-app-layout>
