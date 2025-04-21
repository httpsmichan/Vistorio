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
                <!-- Same Visitor Multiple Times Today -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold mb-4">Same Visitor Multiple Times Today</h3>
                    <div class="space-y-3">
                        @forelse ($sameVisitorMultipleTimes as $visitor)
                            <div class="flex justify-between items-center bg-gray-100 p-4 rounded shadow-sm">
                                <span class="font-medium text-gray-800">{{ $visitor->full_name }}</span>
                                <span class="text-sm text-blue-600 font-semibold">{{ $visitor->visits }} visits</span>
                            </div>
                        @empty
                            <p class="text-gray-500">No repeat visitors today.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Hosts Not Responding -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold mb-4">Pending Appointments</h3>
                    <div class="space-y-3">
                        @forelse ($hostsNotResponding as $host)
                            <div class="flex justify-between items-center bg-yellow-100 p-4 rounded shadow-sm">
                                <span class="font-medium text-gray-800">{{ $host->host }}</span>
                                <span class="text-sm text-yellow-600 font-semibold">{{ $host->pending_count }} pending</span>
                            </div>
                        @empty
                            <p class="text-gray-500">No pending appointments found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Excessive Rejections -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold mb-4">Excessive Appointment Rejections</h3>
                    <div class="space-y-3">
                        @forelse ($excessiveRejections as $user)
                            <div class="flex justify-between items-center bg-red-100 p-4 rounded shadow-sm">
                                <span class="font-medium text-gray-800">User ID: {{ $user->user_id }}</span>
                                <span class="text-sm text-red-600 font-semibold">{{ $user->appointments_count ?? 'N/A' }} rejections</span>
                            </div>
                        @empty
                            <p class="text-gray-500">No users with excessive rejections.</p>
                        @endforelse
                    </div>
                </div>


                                <!-- Failed Login Attempts Bar Chart -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Failed Login Attempts</h3>
                    <canvas id="failedLoginChart" height="100"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('failedLoginChart').getContext('2d');

                    const failedLoginChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($failedLogins->pluck('date')) !!},
                            datasets: [{
                                label: 'Failed Attempts',
                                data: {!! json_encode($failedLogins->pluck('attempts')) !!},
                                backgroundColor: '#f87171', // Tailwind red-400
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Attempts'
                                    },
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0,
                                        callback: function(value) {
                                            if (Number.isInteger(value)) {
                                                return value;
                                            }
                                        }
                                    }
                                }

                            }
                        }
                    });
                </script>


                <!-- Latest Role Changes -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Latest User Role Changes</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">User ID</th>
                                <th class="border border-gray-300 px-4 py-2">Old Role</th>
                                <th class="border border-gray-300 px-4 py-2">New Role</th>
                                <th class="border border-gray-300 px-4 py-2">Changed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roleChanges as $roleChange)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->user_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->old_role }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->new_role }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
