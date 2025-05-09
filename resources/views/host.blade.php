<x-app-layout>
    <div class="py-0">
        <div class="flex">
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
            <div class=" w-[1200px] h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/room.jpg') }}');">
 
            </div>
        </div>
    </div>
</x-app-layout>
