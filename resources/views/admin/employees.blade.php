<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Management') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex space-x-4"> 
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointments') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">
                                Appointments
                            </a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="{{ route('admin.visitor.logs') }}" class="block px-4 py-2 bg-white rounded">Visitor Logs</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">
                                User Management
                            </a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="{{ route('admin.employees') }}" class="block px-4 py-2 bg-white rounded">Employee Management</a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="{{ route('admin.notifications') }}" class="block px-4 py-2 bg-white rounded">Notifications</a>
                        </li>
                        <li class="opacity-50 cursor-not-allowed">
                            <a href="{{ route('admin.analytics') }}" class="block px-4 py-2 bg-white rounded">Reports & Analytics</a>
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Add New Employee</h3>

                    <!-- Form to Add Employee to Organization -->
                    <form method="POST" action="{{ route('admin.saveEmployee') }}" class="mb-4">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" name="name" id="name" class="border p-2 w-full" value="{{ old('name') }}" required>
                        </div>

                        <!-- Position Input -->
                        <div class="mb-4">
                            <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                            <input type="text" name="position" id="position" class="border p-2 w-full" value="{{ old('position') }}" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Save Employee</button>
                    </form>

                    <h3 class="text-lg font-semibold mb-4">All Employees</h3>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-3/4 border rounded" placeholder="Search by Name or Position..." oninput="searchEmployees()">
                    </div>

                    <!-- Employee List Table -->
                    @if($employees->count() > 0)
                    <table class="table-auto w-full border-collapse border border-gray-300">
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
                                <tr class="employee-item" data-name="{{ $employee->name }}" data-position="{{ $employee->position }}">
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
    </div>

    <!-- Search Script -->
    <script>
        function searchEmployees() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let employeeItems = document.querySelectorAll('.employee-item');
            
            employeeItems.forEach(item => {
                let name = item.getAttribute('data-name').toLowerCase();
                let position = item.getAttribute('data-position').toLowerCase();

                if (name.includes(searchQuery) || position.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
