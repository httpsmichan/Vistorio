<x-app-layout>
    <div class="flex flex-col md:flex-row min-w-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white top-0 left-0 h-screen  z-20">
            <h3 class="text-1xl font-bold m-5 text-center">VISTORIO</h3>
            <nav class="space-y-2 ml-5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-home"></i>
                    <span class="hidden md:inline">Dashboard</span>
                </a>
                <a href="{{ route('visit.history') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-[#1e2c3b] rounded-lg">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="hidden md:inline">Appointment History</span>
                </a>
                <a href="{{ route('visitor.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-bell"></i>
                    <span class="hidden md:inline">Notifications</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="bg-white flex-1 py-5 px-5 min-w-0">
            <!-- Top Navigation Bar -->
            <div class="top-0 left-64 right-0 bg-white z-10 flex justify-end items-center px-5 py-3 h-16">
                <a href="#" class="btn bg-gray-300 px-2 py-2 mr-2 btn-outline">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </a>
                <a href="{{ route('appointments') }}" class="btn bg-black py-2 px-2 text-white btn-primary">
                    <i class="fas fa-plus"></i> Schedule Appointment
                </a>
            </div>

            <!-- Appointments Table -->
            <div class="bg-white rounded shadow p-4 w-full">
                <h3 class="text-lg font-bold mb-4">Appointments History</h3>
                @if($appointments->count())
                    <div class="overflow w-full">
                        <table class="w-full table-auto border border-gray-300 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Purpose</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Preferred Date & Time</th>
                                    <th class="px-4 py-2 border">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="text-center">
                                        <td class="px-4 py-2 border">{{ $appointment->name }}</td>
                                        <td class="px-4 py-2 border">{{ $appointment->purpose }}</td>
                                        <td class="px-4 py-2 border">{{ $appointment->status }}</td>
                                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y H:i') }}</td>
                                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">No appointments found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
