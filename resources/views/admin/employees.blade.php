<x-app-layout>
    <div class="flex min-h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white fixed md:relative min-h-screen transition-all duration-300">
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
        <div class="flex-1 bg-white w-full m-5 shadow-sm sm:rounded-lg p-6 overflow-y-auto" style="max-height: calc(100vh - 2rem);">
            <h3 class="text-lg font-semibold mb-4">Add New Employee</h3>

            <form method="POST" action="{{ route('admin.saveEmployee') }}" class="mb-4">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" name="name" id="name" class="border p-2 w-full" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                    <input type="text" name="position" id="position" class="border p-2 w-full" value="{{ old('position') }}" required>
                </div>

                <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Save Employee</button>
            </form>

            <h3 class="text-lg font-semibold mb-4">All Employees</h3>

            <!-- Search Bar -->
            <div class="mb-4">
                <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by ID, Name, or Position..." oninput="searchEmployees()">
            </div>

            <!-- Employee List Table -->
            @if($employees->count() > 0)
            <table class="table-auto w-full border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border text-left">ID</th>
                        <th class="px-4 py-2 border text-left">Name</th>
                        <th class="px-4 py-2 border text-left">Position</th>
                        <th class="px-4 py-2 border text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="employeeTable">
                    @foreach ($employees as $employee)
                        <tr class="employee-item" data-id="{{ $employee->id }}" data-name="{{ $employee->name }}" data-position="{{ $employee->position }}">
                            <td class="px-4 py-2 border">{{ $employee->id }}</td>
                            <td class="px-4 py-2 border">{{ $employee->name }}</td>
                            <td class="px-4 py-2 border">{{ $employee->position }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-gray-500">No employees found.</p>
            @endif
        </div>
    </div>

    <!-- Search Script -->
    <script>
        function searchEmployees() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let employeeItems = document.querySelectorAll('.employee-item');
            
            employeeItems.forEach(item => {
                let id = item.getAttribute('data-id').toString().toLowerCase();
                let name = item.getAttribute('data-name').toLowerCase();
                let position = item.getAttribute('data-position').toLowerCase();

                if (id.includes(searchQuery) || name.includes(searchQuery) || position.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
