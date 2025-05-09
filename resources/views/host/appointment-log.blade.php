<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="flex space-x-4">
            <!-- Sidebar (Original) -->
            <div class="w-64 bg-[#27374D] text-white fixed md:relative h-auto transition-all duration-300">
                <h3 class="text-1xl font-bold m-5 hidden md:block text-center">VISTORIO</h3>
                <nav class="space-y-2">
                    <a href="{{ route('manage.appointments') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-calendar-check"></i>
                        <span class="hidden md:inline">Manage Appointments</span>
                    </a>
                    <a href="{{ route('host.calendar') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="hidden md:inline">Appointment Calendar</span>
                    </a>
                    <a href="{{ route('appointment.logs') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="hidden md:inline">Appointment Logs</span>
                    </a>
                    <a href="{{ route('host.visitor-logs') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-users"></i>
                        <span class="hidden md:inline">Visitor Logs</span>
                    </a>
                    <a href="{{ route('host.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-bell"></i>
                        <span class="hidden md:inline">Notifications</span>
                    </a>
                </nav>
            </div>

            <!-- Main Content (Updated) -->
            <div class="flex-1 bg-white shadow-md rounded-lg p-8 mt-5 ml-64 min-h-screen overflow-y-auto">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Appointments</h3>

                <!-- Filter Section -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('appointment.logs') }}" class="flex items-center justify-end space-x-6">
                        <div class="flex items-center">
                            <label for="filter_type" class="text-sm font-medium text-gray-700 mr-2">Filter By:</label>
                            <select id="filter_type" name="filter_type" class="px-6 py-2 border rounded-md text-sm" onchange="toggleFilterInput()">
                                <option value="status" {{ request('filter_type') === 'status' ? 'selected' : '' }}>Status</option>
                                <option value="date" {{ request('filter_type') === 'date' ? 'selected' : '' }}>Date</option>
                            </select>
                        </div>

                        <!-- Status Dropdown -->
                        <div id="status_filter" class="flex items-center" style="{{ request('filter_type') === 'date' ? 'display:none;' : '' }}">
                            <label for="status" class="text-sm font-medium text-gray-700 mr-2">Status:</label>
                            <select name="status" id="status" class="px-6 py-2 border rounded-md text-sm">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <!-- Date Picker -->
                        <div id="date_filter" class="flex items-center" style="{{ request('filter_type') === 'status' || !request('filter_type') ? 'display:none;' : '' }}">
                            <label for="date" class="text-sm font-medium text-gray-700 mr-2">Date:</label>
                            <input type="date" name="date" id="date" value="{{ request('date') }}" class="px-6 py-2 border rounded-md text-sm">
                        </div>

                        <div>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Filter</button>
                        </div>
                    </form>
                </div>

                <!-- Search Bar -->
                <div class="mb-6">
                    <input id="searchBar" type="text" class="px-6 py-2 w-full border rounded-md text-sm" placeholder="Search by Visitor Name..." oninput="searchLogs()">
                </div>

                <!-- Logs Section -->
                <div class="space-y-4">
                    @foreach($appointments as $appointment)
                        <div class="appointment-log p-4 mb-4 border rounded-lg shadow-sm bg-gray-50"
                             data-name="{{ $appointment->name }}"
                             data-status="{{ $appointment->status }}">

                            @if($appointment->status == 'completed')
                                <p class="text-sm text-gray-700"><strong>{{ $appointment->name }}</strong> completed an appointment on {{ \Carbon\Carbon::parse($appointment->updated_at)->format('M d, Y h:i A') }}.</p>
                            @else
                                <p class="text-sm text-gray-700"><strong>{{ $appointment->name }}</strong> booked an appointment on {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y h:i A') }}.</p>
                            @endif
                            
                            <p class="text-sm text-gray-600"><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y h:i A') }}</p>
                            <p class="text-sm text-gray-600"><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
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
        }

        function searchLogs() {
            const query = document.getElementById('searchBar').value.toLowerCase();
            const logs = document.querySelectorAll('.appointment-log');

            logs.forEach(log => {
                const name = log.getAttribute('data-name').toLowerCase();
                log.style.display = name.includes(query) ? '' : 'none';
            });
        }
    </script>
</x-app-layout>
