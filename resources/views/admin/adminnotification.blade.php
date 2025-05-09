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
            <div class="flex-1 w-full m-5 bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <button id="visitorBtn" class="bg-blue-500 text-black px-4 py-2 rounded mr-4" onclick="toggleNotifications('visitor')">Visitors Notifications</button>
                    <button id="appointmentBtn" class="bg-green-500 text-black px-4 py-2 rounded" onclick="toggleNotifications('appointment')">Appointments Notifications</button>
                </div>

                <!-- Visitors Notifications -->
                <div id="visitorNotifications" class="space-y-6 hidden">
                    <!-- Visitors with 10 Minutes or Less Remaining -->
                    <div class="bg-yellow-100 p-4 rounded-md shadow-md text-sm">
                        <h4 class="font-medium text-lg mb-2">Visitors Due Time</h4>
                        @foreach ($visitorNotifications as $visitor)
                            @php
                                $visitStart = \Carbon\Carbon::parse($visitor->visit_time)->timezone('Asia/Manila');
                                $visitEnd = $visitStart->copy()->addHour();
                                $now = \Carbon\Carbon::now('Asia/Manila');
                                $remainingMinutes = $now->floatDiffInMinutes($visitEnd, false);
                            @endphp

                            @if (!$visitor->logged_out_at && $remainingMinutes > 0 && $remainingMinutes <= 10)
                                <div class="p-2 mb-1 border-b">
                                    <p><strong>{{ $visitor->full_name }}</strong> is approaching the time limit.</p>
                                    <p><strong>Visit Time:</strong> {{ $visitStart->format('Y-m-d H:i:s') }}</p>
                                    <p><strong>Remaining Time:</strong> {{ number_format($remainingMinutes, 1) }} minutes</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Visitors who have Logged Out -->
                    <div class="bg-red-100 p-4 rounded-md shadow-md text-sm">
                        <h4 class="font-medium text-lg mb-2">Visitors Who Have Logged Out</h4>
                        @foreach ($visitorNotifications as $visitor)
                            @if ($visitor->logged_out_at)
                                <div class="p-2 mb-1 border-b">
                                    <p><strong>{{ $visitor->full_name }}</strong> has logged out.</p>
                                    <p><strong>Visit Time:</strong> {{ \Carbon\Carbon::parse($visitor->visit_time)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}</p>
                                    <p><strong>Logged Out At:</strong> {{ \Carbon\Carbon::parse($visitor->logged_out_at)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Appointments Notifications -->
                <div id="appointmentNotifications" class="space-y-6 hidden">
                    <div class="bg-red-100 p-4 rounded-md shadow-md text-sm">
                        <h4 class="font-medium text-lg">Past Appointments</h4>
                        @foreach ($pastAppointments as $appointment)
                            <div class="p-2 mb-1 border-b">
                                <p><strong>{{ $appointment->name }}</strong> had an appointment scheduled at {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}. The appointment has passed.</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-green-100 p-4 rounded-md shadow-md text-sm">
                        <h4 class="font-medium text-lg">Completed Appointments</h4>
                        @foreach ($completedAppointments as $appointment)
                            <div class="p-2 mb-1 border-b">
                                <p><strong>{{ $appointment->name }}</strong>'s appointment was marked as <strong>Completed</strong> on {{ \Carbon\Carbon::parse($appointment->updated_at)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}.</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleNotifications(type) {
            document.getElementById('visitorNotifications').classList.add('hidden');
            document.getElementById('appointmentNotifications').classList.add('hidden');
            
            if (type === 'visitor') {
                document.getElementById('visitorNotifications').classList.remove('hidden');
            } else {
                document.getElementById('appointmentNotifications').classList.remove('hidden');
            }
        }

        window.onload = function() {
            toggleNotifications('visitor');
        }
    </script>
</x-app-layout>
