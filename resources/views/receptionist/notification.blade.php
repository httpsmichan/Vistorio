<x-app-layout>
    <div class="flex h-screen overflow-hidden font-sans bg-gray-50 text-gray-800">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white fixed h-full">
            <h3 class="text-1xl font-bold m-5 hidden md:block text-center">VISTORIO</h3>
            <nav class="space-y-2 px-2">
                <a href="{{ route('walk-in.create') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-user-plus"></i>
                    <span class="hidden md:inline">Walk-in Registration</span>
                </a>
                <a href="{{ route('log-out.search') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="hidden md:inline">Visitor Log-out</span>
                </a>
                <a href="{{ route('receptionist.appointments.lookup') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="hidden md:inline">Appointment Lookup</span>
                </a>
                <a href="{{ route('receptionist.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-bell"></i>
                    <span class="hidden md:inline">Notifications</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 ml-64 overflow-y-auto p-4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium mb-4">Notifications</h3>

                <!-- Toggle Buttons -->
                <div class="mb-6 space-x-2">
                    <button id="visitorBtn" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition text-sm" onclick="toggleNotifications('visitor')">
                        Visitors Notifications
                    </button>
                    <button id="appointmentBtn" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition text-sm" onclick="toggleNotifications('appointment')">
                        Appointments Notifications
                    </button>
                </div>

                <!-- Visitor Notifications -->
                <section id="visitorNotifications" class="space-y-4 hidden">
                    <!-- Approaching Due Time -->
                    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded">
                        <h4 class="font-medium text-sm mb-2">Visitors Due Time</h4>
                        @foreach ($visitorNotifications as $visitor)
                            @php
                                $visitStart = \Carbon\Carbon::parse($visitor->visit_time)->timezone('Asia/Manila');
                                $visitEnd = $visitStart->copy()->addHour();
                                $now = \Carbon\Carbon::now('Asia/Manila');
                                $remainingMinutes = $now->floatDiffInMinutes($visitEnd, false);
                            @endphp

                            @if (!$visitor->logged_out_at && $remainingMinutes > 0 && $remainingMinutes <= 10)
                                <div class="border-b py-2 text-sm">
                                    <p><strong>{{ $visitor->full_name }}</strong> is approaching the time limit.</p>
                                    <p>Visit Time: {{ $visitStart->format('Y-m-d H:i:s') }}</p>
                                    <p>Remaining Time: {{ number_format($remainingMinutes, 1) }} minutes</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Logged Out -->
                    <div class="bg-red-50 border border-red-200 p-4 rounded">
                        <h4 class="font-medium text-sm mb-2">Visitors Who Have Logged Out</h4>
                        @foreach ($visitorNotifications as $visitor)
                            @if ($visitor->logged_out_at)
                                <div class="border-b py-2 text-sm">
                                    <p><strong>{{ $visitor->full_name }}</strong> has logged out.</p>
                                    <p>Visit Time: {{ \Carbon\Carbon::parse($visitor->visit_time)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}</p>
                                    <p>Logged Out At: {{ \Carbon\Carbon::parse($visitor->logged_out_at)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>

                <!-- Appointment Notifications -->
                <section id="appointmentNotifications" class="space-y-4 hidden">
                    <!-- Past Appointments -->
                    <div class="bg-red-50 border border-red-200 p-4 rounded">
                        <h4 class="font-medium text-sm mb-2">Past Appointments</h4>
                        @foreach ($pastAppointments as $appointment)
                            <div class="border-b py-2 text-sm">
                                <p><strong>{{ $appointment->name }}</strong> had an appointment at {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}.</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Completed Appointments -->
                    <div class="bg-green-50 border border-green-200 p-4 rounded">
                        <h4 class="font-medium text-sm mb-2">Completed Appointments</h4>
                        @foreach ($completedAppointments as $appointment)
                            <div class="border-b py-2 text-sm">
                                <p><strong>{{ $appointment->name }}</strong>'s appointment was marked as completed on {{ \Carbon\Carbon::parse($appointment->updated_at)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}.</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </main>
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

        window.onload = function () {
            toggleNotifications('visitor');
        }
    </script>
</x-app-layout>
