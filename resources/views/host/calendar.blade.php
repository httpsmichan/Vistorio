<x-app-layout>

    <div class="">
        <div class="flex space-x-4">
            <!-- Sidebar -->
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

            <!-- Main Content -->
            <div class="flex-1 bg-white h-screen m-5 shadow-sm sm:rounded-lg p-6">
                   <h3 class="text-lg font-semibold mb-4">Appointments Calendar</h3>
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
                        item.style.display = '';  
                        matched = true;
                    } else {
                        item.style.display = 'none';  
                    }
                });

                if (matched) {
                    group.style.display = ''; 
                } else {
                    group.style.display = 'none'; 
                }
            });
        }
    </script>
</x-app-layout>
