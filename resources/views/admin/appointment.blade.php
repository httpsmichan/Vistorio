<x-app-layout>
    <div class="py-0 px-0">
        <div class="flex min-h-screen overflow-hidden">
            <!-- Sidebar -->
            <div class="w-64 bg-[#27374D] text-white fixed md:relative min-h-screen transition-all duration-300 m-0 p-0">
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
            <div class="flex-1 w-full m-5 bg-white shadow-sm sm:rounded-lg p-6 overflow-y-auto max-h-screen">
                <h3 class="text-lg font-semibold">Appointments</h3>

                <!-- Filter Dropdown -->
                <div class="mb-0" style="display: flex; justify-content: flex-end;">
                    <form method="GET" action="{{ route('admin.appointments') }}" id="statusFilterForm" style="min-width: 300px;">
                        <label for="status" class="mr-1">Filter by Status:</label>
                        <select id="status" name="status" class="px-8 py-1 border rounded" onchange="this.form.submit()" style="min-width: 120px;">
                            <option value="">All</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </div>

                <!-- Search Bar for Appointments -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Name, Email, Phone, or Host..." oninput="searchAppointments()">
                    </div>
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                                <th class="border border-gray-300 px-4 py-2">Email</th>
                                <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                                <th class="border border-gray-300 px-4 py-2">Purpose</th>
                                <th class="border border-gray-300 px-4 py-2">Preferred Date & Time</th>
                                <th class="border border-gray-300 px-4 py-2">Host</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody id="appointmentsTable">
                            @forelse ($appointments as $appointment)
                                <tr class="appointment-item" data-name="{{ $appointment->name }}" data-email="{{ $appointment->email }}" data-phone="{{ $appointment->phone_number }}" data-status="{{ $appointment->status }}" data-host="{{ $appointment->host }}">
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->phone_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->purpose }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->preferred_date_time }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->host }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">No appointments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Script -->
    <script>
        function searchAppointments() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let appointmentItems = document.querySelectorAll('.appointment-item');
            
            appointmentItems.forEach(item => {
                let name = item.getAttribute('data-name').toLowerCase();
                let email = item.getAttribute('data-email').toLowerCase();
                let phone = item.getAttribute('data-phone').toLowerCase();
                let host = item.getAttribute('data-host').toLowerCase();

                if (name.includes(searchQuery) || email.includes(searchQuery) || phone.includes(searchQuery) || host.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
