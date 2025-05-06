<x-app-layout>

    <div class="py-6 px-4">
        <div class="flex space-x-4">
            <!-- Sidebar -->
            <div class="w-1/5 bg-gray-100 p-4 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-4">Menu</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.appointments') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointments</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.visitor.logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Logs</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">User Management</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.employees') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Employee Management</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.notifications') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.analytics') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Reports & Analytics</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
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
