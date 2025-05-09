<x-app-layout>

    <div class="flex min-h-screen">
        <div class="flex space-x-4 w-full">

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
                <div class="flex-1 bg-white m-5 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">User Management</h3>

                <!-- Filter by -->
                    <div class="mb-0" style="display: flex; justify-content: flex-end;">
                        <form method="GET" action="{{ route('admin.users.index') }}" id="roleFilterForm" style="min-width: 300px;">
                            <label for="role" class="mr-1">Filter by Role:</label>
                            <select id="role" name="role" class="px-8 py-1 border rounded" onchange="this.form.submit()" style="min-width: 120px;">
                                <option value="">All</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="receptionist" {{ request('role') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                                <option value="host" {{ request('role') == 'host' ? 'selected' : '' }}>Host</option>
                                <option value="visitor" {{ request('role') == 'visitor' ? 'selected' : '' }}>Visitor</option>
                            </select>
                        </form>
                    </div>

                    <!-- Search Bar -->
                    <div class="bg-white shadow-sm sm:rounded-lg mt-5 mb-5">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Search by ID, Name or Email..." oninput="searchUsers()">
                    </div>

                    <!-- Users Table -->
                    <table class="w-full bg-white border border-gray-200 text-sm">
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
    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-gray-50 p-4 rounded shadow-md max-w-lg mx-auto">
        @csrf
        <h3 class="text-lg font-semibold mb-4 text-center">Add New User</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2">
                    <option value="">Select Role</option>
                    <option value="visitor">Visitor</option>
                    <option value="host">Host</option>
                    <option value="admin">Admin</option>
                    <option value="receptionist">Receptionist</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2" />
            </div>
        </div>
        <div class="mt-6 text-center">
            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600 transition">Add User</button>
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
            let id = item.getAttribute('data-id').toString().toLowerCase();
            let name = item.getAttribute('data-name').toLowerCase();
            let email = item.getAttribute('data-email').toLowerCase();
            
            if (id.includes(searchQuery) || name.includes(searchQuery) || email.includes(searchQuery)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>


</x-app-layout>
