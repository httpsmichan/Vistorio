<x-app-layout> 
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white fixed md:relative min-h-screen transition-all duration-300 z-20">
            <h3 class="text-1xl font-bold m-5 text-center">VISTORIO</h3>
            <nav class="space-y-2 ml-5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-home"></i>
                    <span class="hidden md:inline">Dashboard</span>
                </a>
                <a href="{{ route('visit.history') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="hidden md:inline">Visitor History</span>
                </a>
                <a href="{{ route('visitor.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-[#1e2c3b]">
                    <i class="fas fa-bell"></i>
                    <span class="hidden md:inline">Notifications</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-white py-5 px-5 min-w-0 overflow-auto">
            <h2 class="text-2xl font-bold mb-4">Approved Appointment Notifications</h2>

            @if($approvedAppointments->count())
                <div class="bg-white mt-6 rounded shadow p-4 w-full">
                    <table class="w-full table-auto border border-gray-300 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Purpose</th>
                                <th class="px-4 py-2 border">Preferred Date & Time</th> <!-- New column -->
                                <th class="px-4 py-2 border">Approved Date</th>
                                <th class="px-4 py-2 border">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedAppointments as $appointment)
                                <tr class="text-center">
                                    <td class="px-4 py-2 border">{{ $appointment->name }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->purpose }}</td>
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($appointment->preferred_date_time)->format('M d, Y H:i') }}</td> <!-- New column -->
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($appointment->updated_at)->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($appointment->updated_at)->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">No approved appointments found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
