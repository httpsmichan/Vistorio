<x-app-layout>

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

            <!-- Main Content (Visitor Logs Table) -->
            <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">Visitor Logs</h3>
                <!-- Search Bar -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Visitor Name, Status, Host, Floor, or Visit Date..." oninput="searchLogs()">
                </div>

                <table class="w-full border-collapse border border-gray-300">
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

    <!-- JavaScript for Search Functionality -->
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
