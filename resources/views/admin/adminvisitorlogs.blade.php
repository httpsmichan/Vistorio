<x-app-layout>

    <div class="flex min-h-screen">
        <div class="flex space-x-4 w-full">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white fixed md:relative min-h-screen transition-all duration-300">
            <h3 class="text-1xl font-bold m-5 hidden md:block text-center">VISTORIO</h3>
            <nav class="space-y-2">
                <a href="{{ route('admin') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-home"></i>
                    <span class="hidden md:inline">Dashboard</span>
                </a>
                <a href="{{ route('admin.appointments') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-calendar-check"></i>
                    <span class="hidden md:inline">Appointments</span>
                </a>
                <a href="{{ route('admin.visitor.logs') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="hidden md:inline">Visitor Logs</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-users-cog"></i>
                    <span class="hidden md:inline">User Management</span>
                </a>
                <a href="{{ route('admin.employees') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-user-tie"></i>
                    <span class="hidden md:inline">Employee Management</span>
                </a>
                <a href="{{ route('admin.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-bell"></i>
                    <span class="hidden md:inline">Notifications</span>
                </a>
                <a href="{{ route('admin.analytics') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-chart-line"></i>
                    <span class="hidden md:inline">Reports & Analytics</span>
                </a>
            </nav>
        </div>

            <!-- Main Content -->
            <div class="flex-1 m-5  bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">Visitor Logs</h3>

                <!-- Search Bar -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Visitor Name, Status, Host, Floor, or Visit Date..." oninput="searchLogs()">
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
