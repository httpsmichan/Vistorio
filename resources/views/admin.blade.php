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


                <div class="w-3/4 pl-4">
                    <div class="flex justify-center mb-6">
                        <!-- Total Users -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/3 mx-[5px]">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold">Total Users</h3>
                                <p class="text-3xl font-bold text-blue-500">{{ $users->count() }}</p>
                            </div>
                        </div>

                        <!-- Total Appointments -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/3 mx-[5px]">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold">Total Appointments</h3>
                                <p class="text-3xl font-bold text-green-500">{{ $appointments->count() }}</p>
                            </div>
                        </div>

                        <!-- Total Visitors -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/3 mx-[5px]">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold">Total Visitors</h3>
                                <p class="text-3xl font-bold text-purple-500">{{ $visitors->count() }}</p>
                            </div>
                        </div>
                    </div>


                    <div class="mb-6">
                        <a href="{{ route('admin.users.add') }}" class="px-4 py-2 bg-green-500 text-black rounded-lg hover:bg-green-600">
                            Add an Account
                        </a>
                    </div>

                    <!-- User Registrations Per Day -->
                    <div class="bg-white p-6 rounded-lg shadow-sm mt-6">
                        <h3 class="text-lg font-semibold mb-4">User Registration Evaluation</h3>
                        <canvas id="userRegistrationsChart" height="100"></canvas>

                        <!-- Direct Script Below -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const ctxUsers = document.getElementById('userRegistrationsChart').getContext('2d');
                            const userRegistrationsChart = new Chart(ctxUsers, {
                                type: 'bar',
                                data: {
                                    labels: @json($userRegistrationsByDay->pluck('date')),
                                    datasets: [{
                                        label: 'Users Registered',
                                        data: @json($userRegistrationsByDay->pluck('count')),
                                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                        borderRadius: 5
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1,
                                                precision: 0
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>

                    <!-- Appointments Per Day -->
                    <div class="bg-white p-6 rounded-lg shadow-sm mt-6 w-full">
                        <h3 class="text-lg font-semibold mb-4">Appointments Evaluation</h3>
                        <canvas id="appointmentsChart" height="100"></canvas>

                        <script>
                            const ctxAppointments = document.getElementById('appointmentsChart').getContext('2d');
                            const appointmentsChart = new Chart(ctxAppointments, {
                                type: 'bar',
                                data: {
                                    labels: @json($appointmentsByDay->pluck('date')),
                                    datasets: [{
                                        label: 'Appointments',
                                        data: @json($appointmentsByDay->pluck('count')),
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderRadius: 5
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1,
                                                precision: 0
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>

                    <!-- Visitor Registrations Per Day -->
                    <div class="bg-white p-6 rounded-lg shadow-sm mt-6 w-full">
                        <h3 class="text-lg font-semibold mb-4">Visitor Entry Evaluation</h3>
                        <canvas id="visitorRegistrationsChart" height="100"></canvas>

                        <script>
                            const ctxVisitors = document.getElementById('visitorRegistrationsChart').getContext('2d');
                            const visitorRegistrationsChart = new Chart(ctxVisitors, {
                                type: 'bar',
                                data: {
                                    labels: @json($visitorRegistrationsByDay->pluck('date')),
                                    datasets: [{
                                        label: 'Visitors',
                                        data: @json($visitorRegistrationsByDay->pluck('count')),
                                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                        borderRadius: 5
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1,
                                                precision: 0
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
