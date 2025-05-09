<x-app-layout>

    <div class="flex min-h-screen">
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
            <div class="flex-1 w-full m-5 bg-white shadow-sm sm:rounded-lg p-6">
     
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
                                backgroundColor: '#f87171', 
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
</x-app-layout>
