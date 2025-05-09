<x-app-layout>

   <div class="py-0 h-screen">
        <div class="flex space-x-4">
<!-- Sidebar -->
<div class="w-64 bg-[#27374D] text-white fixed md:relative h-screen transition-all duration-300">
    <h3 class="text-1xl font-bold m-5 hidden md:block text-center">VISTORIO</h3>
    <nav class="space-y-2">
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
                <div class="flex-1 m-5 bg-white shadow-sm sm:rounded-lg p-6 ">
                                        <h3 class="text-lg font-semibold mb-4">Register Visitor</h3>
                    <div class="p-6 text-gray-900">

                        <!-- Walk-In Registration Form -->
                        <form method="POST" action="{{ route('walk-in.store') }}">
                            @csrf

                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Visitor #</label>
                                <input type="text" name="visitor_number" class="border p-2 w-full" value="{{ $nextVisitorNumber }}" readonly required>
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" class="border p-2 w-full" required>
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Age</label>
                                <input type="number" name="age" class="border p-2 w-full" required>
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Which Floor?</label>
                                <input type="number" name="floor" id="floor" class="border p-2 w-full" required oninput="updateFloorSuffix()">
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Host (Who will they visit?)</label>
                                <input type="text" name="host" class="border p-2 w-full" required value="{{ old('host') }}">
                                @error('host')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <label class="block font-medium text-gray-700">Time & Date</label>
                                <input type="datetime-local" name="visit_time" class="border p-2 w-full" required value="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>

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
