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

            <!-- Main Content -->
            <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">Appointments</h3>
                <!-- Search Bar for Appointments -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Name, Email, Phone, Status, or Host..." oninput="searchAppointments()">
                    </div>
                    <table class="w-full border-collapse border border-gray-300">
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

                <!-- Search Bar for Pending Appointments -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Pending Appointments</h3>
                    <div class="mb-4">
                        <input id="pendingSearchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search Pending Appointments by Name, Email, Phone, or Host..." oninput="searchPendingAppointments()">
                    </div>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                                <th class="border border-gray-300 px-4 py-2">Email</th>
                                <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                                <th class="border border-gray-300 px-4 py-2">Purpose</th>
                                <th class="border border-gray-300 px-4 py-2">Preferred Date & Time</th>
                                <th class="border border-gray-300 px-4 py-2">Host</th>
                            </tr>
                        </thead>
                        <tbody id="pendingAppointmentsTable">
                            @forelse ($approvedAppointments as $appointment)
                                <tr class="pending-appointment-item" data-name="{{ $appointment->name }}" data-email="{{ $appointment->email }}" data-phone="{{ $appointment->phone_number }}" data-host="{{ $appointment->host }}">
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->phone_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->purpose }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->preferred_date_time }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->host }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">No pending appointments found.</td>
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
                let status = item.getAttribute('data-status').toLowerCase();
                let host = item.getAttribute('data-host').toLowerCase();

                if (name.includes(searchQuery) || email.includes(searchQuery) || phone.includes(searchQuery) || status.includes(searchQuery) || host.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function searchPendingAppointments() {
            let searchQuery = document.getElementById("pendingSearchBar").value.toLowerCase();
            let pendingAppointmentItems = document.querySelectorAll('.pending-appointment-item');
            
            pendingAppointmentItems.forEach(item => {
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
