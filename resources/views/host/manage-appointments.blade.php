<x-app-layout>

    <div class="">
        <div class="flex space-x-4">
                
            <!-- Sidebar -->
            <div class="w-64 bg-[#27374D] text-white fixed md:relative h-screen transition-all duration-300">
                <h3 class="text-1xl font-bold m-5 hidden md:block text-center">VISTORIO</h3>
                <nav class="space-y-2">
                    <a href="{{ route('manage.appointments') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-calendar-check"></i>
                        <span class="hidden md:inline">Manage Appointments</span>
                    </a>
                    <a href="{{ route('host.calendar') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="hidden md:inline">Appointment Calendar</span>
                    </a>
                    <a href="{{ route('appointment.logs') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="hidden md:inline">Appointment Logs</span>
                    </a>
                    <a href="{{ route('host.visitor-logs') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-users"></i>
                        <span class="hidden md:inline">Visitor Logs</span>
                    </a>
                    <a href="{{ route('host.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                        <i class="fas fa-bell"></i>
                        <span class="hidden md:inline">Notifications</span>
                    </a>
                </nav>
            </div>

                <!-- Main Content -->
<div class="flex-1 bg-white m-5 shadow-sm sm:rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Appointments</h3>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">User ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Date</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $filteredAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->status !== 'completed' && $appointment->status !== 'rejected';
                });
            @endphp

            @forelse ($filteredAppointments as $appointment)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y h:i A') }}
                    </td>
                    <td class="border border-gray-300 px-5 py-2">
                        <select class="status-dropdown border border-gray-300 rounded px-2 py-1 w-full" data-id="{{ $appointment->id }}">
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $appointment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.status-dropdown').change(function () {
                var status = $(this).val();
                var appointmentId = $(this).data('id');

                $.ajax({
                    url: "{{ route('update.appointment.status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: appointmentId,
                        status: status
                    },
                    success: function (response) {
                        alert(response.success);
                    },
                    error: function () {
                        alert("Failed to update status.");
                    }
                });
            });
        });
    </script>
</x-app-layout>
