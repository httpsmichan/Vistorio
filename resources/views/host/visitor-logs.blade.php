<x-app-layout>

    <div class="">
        <div class="flex space-x-4">
            <!-- Sidebar -->
            <div class="w-64 bg-[#27374D] text-white fixed md:relative h-screen transition-all duration-300">
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

            <!-- Main Content (Visitor Logs Table) -->
            <div class="flex-1 bg-white m-5 shadow-sm sm:rounded-lg p-6">
                   <h3 class="text-lg font-semibold mb-4">Visitor Logs</h3>

                <!-- Search Bar -->
                <div class="mb-4">
                    <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Visitor Name, Status, or Booked Date..." oninput="searchLogs()">
                </div>

                <table class="w-full border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Visitor Number</th>
                            <th class="border border-gray-300 px-4 py-2">Full Name</th>
                            <th class="border border-gray-300 px-4 py-2">Age</th>
                            <th class="border border-gray-300 px-4 py-2">Floor</th>
                            <th class="border border-gray-300 px-4 py-2">Host</th>
                            <th class="border border-gray-300 px-4 py-2">Visit Time</th>
                            <th class="border border-gray-300 px-4 py-2">Logged Out At</th>
                        </tr>
                    </thead>
                    <tbody id="visitorTableBody">
                        @forelse ($visitors as $visitor)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->visitor_number }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->full_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->age }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->floor }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->host }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->visit_time }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $visitor->logged_out_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No visitor logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Search Functionality -->
    <script>
        function searchLogs() {
            const searchQuery = document.getElementById('searchBar').value.toLowerCase();
            const rows = document.querySelectorAll('#visitorTableBody tr');

            rows.forEach(row => {
                const visitorNumber = row.cells[0].textContent.toLowerCase();
                const fullName = row.cells[1].textContent.toLowerCase();
                const age = row.cells[2].textContent.toLowerCase();
                const floor = row.cells[3].textContent.toLowerCase();
                const host = row.cells[4].textContent.toLowerCase();
                const visitTime = row.cells[5].textContent.toLowerCase();
                const loggedOutAt = row.cells[6].textContent.toLowerCase();

                if (
                    visitorNumber.includes(searchQuery) ||
                    fullName.includes(searchQuery) ||
                    age.includes(searchQuery) ||
                    floor.includes(searchQuery) ||
                    host.includes(searchQuery) ||
                    visitTime.includes(searchQuery) ||
                    loggedOutAt.includes(searchQuery)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
