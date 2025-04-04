<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
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
                        @foreach($appointments as $appointment)
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
                        @endforeach
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
