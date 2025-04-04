<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('receptionist') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Dashboard</a></li>
                        <li><a href="{{ route('walk-in.create') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Walk-in Registration</a></li>
                        <li><a href="{{ route('log-out.search') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Log-out</a></li>
                        <li><a href="{{ route('receptionist.appointments.lookup') }}" class="block px-4 py-2 bg-white rounded transition">Appointment Lookup</a></li>
                        <li><a href="{{ route('receptionist.notifications') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a></li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="w-3/4 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Notifications</h3>

                    <!-- Buttons to toggle notifications -->
                    <div class="mb-4">
                        <button id="visitorBtn" class="bg-blue-500 text-black px-4 py-2 rounded mr-4" onclick="toggleNotifications('visitor')">Visitors Notifications</button>
                        <button id="appointmentBtn" class="bg-green-500 text-black px-4 py-2 rounded" onclick="toggleNotifications('appointment')">Appointments Notifications</button>
                    </div>

                    <!-- Notifications Sections -->

                    <!-- Visitors Notifications -->
<div id="visitorNotifications" class="space-y-6 hidden">
    <div class="bg-yellow-100 p-4 rounded-md shadow-md">
        <h4 class="font-medium text-lg">Visitors with 1 Hour Remaining or Exceeded</h4>
        @foreach ($visitorNotifications as $visitor)
            <div class="p-4 mb-2 border-b">
                <p><strong>{{ $visitor->full_name }}</strong> is about to exceed their visit time or has already exceeded.</p>
                <p><strong>Visit Time:</strong> {{ \Carbon\Carbon::parse($visitor->visit_time)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}</p>
                @if ($visitor->logged_out_at)
                    <p class="text-red-600"><strong>{{ $visitor->full_name }}</strong> has logged out at {{ \Carbon\Carbon::parse($visitor->logged_out_at)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}.</p>
                @endif
                <p><strong>Remaining Time:</strong> {{ $visitor->remaining_time }} minutes</p>
            </div>
        @endforeach
    </div>
</div>


                   <!-- Appointments Notifications -->

<div id="appointmentNotifications" class="space-y-6 hidden">
    <!-- Past Appointments -->
    <div class="bg-red-100 p-4 rounded-md shadow-md">
        <h4 class="font-medium text-lg">Past Appointments</h4>
        @foreach ($pastAppointments as $appointment)
            <div class="p-4 mb-2 border-b">
                <p><strong>{{ $appointment->name }}</strong> had an appointment scheduled at {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}. The appointment has passed.</p>
            </div>
        @endforeach
    </div>

    <!-- Completed Appointments -->
    <div class="bg-green-100 p-4 rounded-md shadow-md">
        <h4 class="font-medium text-lg">Completed Appointments</h4>
        @foreach ($completedAppointments as $appointment)
            <div class="p-4 mb-2 border-b">
                <p><strong>{{ $appointment->name }}</strong>'s appointment was marked as <strong>Completed</strong> on {{ \Carbon\Carbon::parse($appointment->updated_at)->timezone('Asia/Manila')->format('Y-m-d H:i:s') }}.</p>
            </div>
        @endforeach
    </div>
</div>


                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle between the visitor and appointment notifications
        function toggleNotifications(type) {
            // Hide both sections initially
            document.getElementById('visitorNotifications').classList.add('hidden');
            document.getElementById('appointmentNotifications').classList.add('hidden');
            
            // Show the selected section
            if (type === 'visitor') {
                document.getElementById('visitorNotifications').classList.remove('hidden');
            } else {
                document.getElementById('appointmentNotifications').classList.remove('hidden');
            }
        }

        // Set the default view to show visitor notifications
        window.onload = function() {
            toggleNotifications('visitor');
        }
    </script>

</x-app-layout>
