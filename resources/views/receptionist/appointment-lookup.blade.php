<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Lookup') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex space-x-4">
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
                <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search name, email, or phone number" oninput="searchAppointments()">
                    </div>

                    <!-- Appointment Results Table -->
                    @if(isset($appointments) && $appointments->count() > 0)
                        <form method="POST" action="{{ route('appointments.update-status') }}">
                            @csrf
                            <div id="appointmentTable">
                                @foreach ($appointments as $appointment)
                                    <div class="border border-gray-300 p-4 mb-4 rounded appointment-item" data-name="{{ $appointment->name }}" data-email="{{ $appointment->email }}" data-phone="{{ $appointment->phone_number }}">
                                        <div class="flex justify-between">
                                            <div class="w-3/4">
                                                <p><strong>ID #</strong> {{ $appointment->id }}</p>
                                                <p><strong>Name:</strong> {{ $appointment->name }}</p>
                                                <p><strong>Email:</strong> {{ $appointment->email }}</p>
                                                <p><strong>Phone:</strong> {{ $appointment->phone_number }}</p>
                                                <p><strong>Appointment Date & Time:</strong> {{ $appointment->preferred_date_time }}</p>
                                                <p><strong>Purpose:</strong> {{ $appointment->purpose }}</p>
                                                <p><strong>Host:</strong> {{ $appointment->host }}</p>
                                                <p><strong>Status:</strong> {{ $appointment->status }}</p>
                                            </div>
                                            <div class="w-1/4 flex items-center justify-center">
                                                <label for="completed_{{ $appointment->id }}" class="inline-flex items-center">
                                                    <input type="checkbox" name="appointments[{{ $appointment->id }}]" id="completed_{{ $appointment->id }}" value="completed" class="form-checkbox" {{ $appointment->status == 'completed' ? 'checked' : '' }}>
                                                    <span class="ml-2">Mark as Completed</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded">Update Status</button>
                            </div>
                        </form>
                    @else
                        <p class="text-gray-500">No appointments found.</p>
                    @endif
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
