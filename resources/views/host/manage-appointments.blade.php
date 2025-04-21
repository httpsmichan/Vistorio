<x-app-layout>

    <div class="py-6 px-4">
        <div class="flex space-x-4">
                
                <!-- Sidebar -->
                <div class="w-[calc(25%-20px)] bg-gray-100 p-4 rounded-lg shadow-sm mx-[10px]">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('manage.appointments') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Manage Appointments</a></li>
                        <li><a href="{{ route('host.calendar') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Calendar</a></li>
                        <li><a href="{{ route('appointment.logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Appointment Logs</a></li>
                        <li><a href="{{ route('host.visitor-logs') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Logs</a></li>
                        <li><a href="{{ route('host.notifications') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a></li>
                    </ul>
                </div>

                <!-- Main Content -->
<div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
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
