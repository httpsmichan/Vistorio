<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Walk-In Registration') }}
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
                        <li><a href="{{ route('walk-in.create') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Walk-In Registration</a></li>
                        <li><a href="{{ route('log-out.search') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Log-out</a></li>
                        <li><a href="{{ route('receptionist.appointments.lookup') }}" class="block px-4 py-2 bg-white rounded transition">Appointment Lookup</a></li>
                        <li><a href="{{ route('receptionist.notifications') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a></li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="w-3/4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Register a Walk-In Visitor</h3>

                        <!-- Walk-In Registration Form -->
                        <form method="POST" action="{{ route('walk-in.store') }}">
                            @csrf

                            <!-- Visitor # (Auto-fill with next available number) -->
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Visitor #</label>
                                <input type="text" name="visitor_number" class="border p-2 w-full" value="{{ $nextVisitorNumber }}" readonly required>
                            </div>

                            <!-- Full Name -->
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" class="border p-2 w-full" required>
                            </div>

                            <!-- Age -->
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Age</label>
                                <input type="number" name="age" class="border p-2 w-full" required>
                            </div>

                            <!-- Floor to Visit -->
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Which Floor?</label>
                                <input type="number" name="floor" id="floor" class="border p-2 w-full" required oninput="updateFloorSuffix()">
                            </div>

                            <!-- Host -->
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Host (Who will they visit?)</label>
                                <input type="text" name="host" class="border p-2 w-full" required>
                            </div>

                            <!-- Time & Date -->
                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Time & Date</label>
                                <input type="datetime-local" name="visit_time" class="border p-2 w-full" required value="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">
                                    Register Visitor
                                </button>
                            </div>
                        </form>

                        @if(session('success'))
                            <p class="text-green-500 mt-4">{{ session('success') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFloorSuffix() {
            let floorInput = document.getElementById('floor');
            let suffixSpan = document.getElementById('floorSuffix');
            let floor = parseInt(floorInput.value);

            if (!isNaN(floor)) {
                let suffix = getOrdinalSuffix(floor);
                suffixSpan.textContent = suffix;
            } else {
                suffixSpan.textContent = '';
            }
        }

        function getOrdinalSuffix(n) {
            if (n >= 11 && n <= 13) {
                return n + "th";
            }
            switch (n % 10) {
                case 1: return n + "st";
                case 2: return n + "nd";
                case 3: return n + "rd";
                default: return n + "th";
            }
        }
    </script>

</x-app-layout>
