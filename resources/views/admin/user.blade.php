<x-app-layout>

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
                <h3 class="text-lg font-semibold">User Management</h3>

                    <!-- Search Bar -->
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by ID, Name, Email, or Role..." oninput="searchUsers()">
                    </div>

                    <!-- Users Table -->
                    <table class="w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="w-full bg-gray-100 border-b">
                                <th class="py-2 px-4 border">ID</th>
                                <th class="py-2 px-4 border">Name</th>
                                <th class="py-2 px-4 border">Email</th>
                                <th class="py-2 px-4 border">Role</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            @foreach ($users as $user)
                                <tr class="border-b user-item" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}">
                                    <td class="py-2 px-4 border">{{ $user->id }}</td>
                                    <td class="py-2 px-4 border">{{ $user->name }}</td>
                                    <td class="py-2 px-4 border">{{ $user->email }}</td>
                                    <td class="py-2 px-4 border">{{ $user->role }}</td>
                                    <td class="py-2 px-4 border">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Add New User Form -->
                <div class="mb-6 m-5">
                    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-gray-50 p-4 rounded shadow m-5">
                        @csrf
                        <h3 class="text-lg font-semibold mb-4 text-center">Add New User</h3>
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <select name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Select Role</option>
                                    <option value="visitor">Visitor</option>
                                    <option value="host">Host</option>
                                    <option value="admin">Admin</option>
                                    <option value="receptionist">Receptionist</option>
                                </select>
                            </div>
                            <div class="col-span-4">
                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">Add User</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    <!-- Search Script -->
    <script>
        function searchUsers() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let userItems = document.querySelectorAll('.user-item');
            
            userItems.forEach(item => {
                let id = item.getAttribute('data-id').toString().toLowerCase();  // Add ID to the search query
                let name = item.getAttribute('data-name').toLowerCase();
                let email = item.getAttribute('data-email').toLowerCase();
                let role = item.getAttribute('data-role').toLowerCase();

                if (id.includes(searchQuery) || name.includes(searchQuery) || email.includes(searchQuery) || role.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

</x-app-layout>
