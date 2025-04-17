<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Appointments') }}
        </h2>
    </x-slot>

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
                        <a href="#" class="block px-4 py-2 bg-white rounded">Visitor Logs</a>
                    </li>
                    <li class="opacity-50 cursor-not-allowed">
                        <a href="#" class="block px-4 py-2 bg-white rounded">System Settings</a>
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
                        <a href="#" class="block px-4 py-2 bg-white rounded">Notifications</a>
                    </li>
                    <li class="opacity-50 cursor-not-allowed">
                        <a href="#" class="block px-4 py-2 bg-white rounded">Reports & Analytics</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                <!-- Display User's Appointments Table -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Appointments</h3>
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by Name, Email, or Phone Number..." oninput="searchAppointments()">
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
                                <th class="border border-gray-300 px-4 py-2">Status</th> <!-- New column -->
                            </tr>
                        </thead>
                        <tbody id="appointmentsTable">
                            @forelse ($appointments as $appointment)
                                <tr class="appointment-item" data-name="{{ $appointment->name }}" data-email="{{ $appointment->email }}" data-phone="{{ $appointment->phone_number }}">
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->phone_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->purpose }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->preferred_date_time }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->host }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->status }}</td> <!-- New cell -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">No appointments found.</td> <!-- updated colspan -->
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Display Approved Appointments Table -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Approved Appointments</h3>
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
                        <tbody>
                            @forelse ($approvedAppointments as $appointment)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->phone_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->purpose }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->preferred_date_time }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->host }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">No approved appointments found.</td>
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

                if (name.includes(searchQuery) || email.includes(searchQuery) || phone.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
