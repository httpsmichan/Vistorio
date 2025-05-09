<x-app-layout>
    <div class="flex min-h-screen ">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white fixed md:relative h-screen transition-all duration-300">
            <h3 class="text-1xl font-bold m-5 hidden md:block text-center">VISTORIO</h3>
            <nav class="space-y-2">
                <a href="{{ route('admin') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-home"></i>
                    <span class="hidden md:inline">Dashboard</span>
                </a>
                <a href="{{ route('admin.appointments') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-calendar-check"></i>
                    <span class="hidden md:inline">Appointments</span>
                </a>
                <a href="{{ route('admin.visitor.logs') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="hidden md:inline">Visitor Logs</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-users-cog"></i>
                    <span class="hidden md:inline">User Management</span>
                </a>
                <a href="{{ route('admin.employees') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-user-tie"></i>
                    <span class="hidden md:inline">Employee Management</span>
                </a>
                <a href="{{ route('admin.notifications') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-bell"></i>
                    <span class="hidden md:inline">Notifications</span>
                </a>
                <a href="{{ route('admin.analytics') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-chart-line"></i>
                    <span class="hidden md:inline">Reports & Analytics</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 px-4 py-6 bg-gray-50 min-h-screen overflow-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('Add New Account') }}</h3>
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" required class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="role" name="role" required class="w-full px-3 py-2 border rounded-lg">
                            <option value="visitor">Visitor</option>
                            <option value="host">Host</option>
                            <option value="admin">Admin</option>
                            <option value="receptionist">Receptionist</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded-lg transition">
                        Add Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
