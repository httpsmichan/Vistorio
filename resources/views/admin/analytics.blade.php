<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analytics') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex gap-6">
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
<!-- Same Visitor Multiple Times Today -->
<div class="bg-white p-6 rounded-lg shadow-sm">
    <h3 class="text-lg font-semibold mb-4">Same Visitor Multiple Times Today</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Visitor Name</th>
                <th class="border border-gray-300 px-4 py-2">Visit Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sameVisitorMultipleTimes as $visitor)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $visitor->full_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $visitor->visits }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


                <!-- Hosts Not Responding -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Hosts Not Responding to Appointments</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Host</th>
                                <th class="border border-gray-300 px-4 py-2">Pending Appointments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hostsNotResponding as $host)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $host->host }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Pending</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Excessive Rejections -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Excessive Appointment Rejections</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">User ID</th>
                                <th class="border border-gray-300 px-4 py-2">Rejections Today</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($excessiveRejections as $user)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->user_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->appointments_count ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Failed Login Attempts -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Failed Login Attempts</h3>
                    <p>Total failed login attempts: {{ $failedLogins }}</p>
                </div>

                <!-- Latest Role Changes -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Latest User Role Changes</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">User ID</th>
                                <th class="border border-gray-300 px-4 py-2">Old Role</th>
                                <th class="border border-gray-300 px-4 py-2">New Role</th>
                                <th class="border border-gray-300 px-4 py-2">Changed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roleChanges as $roleChange)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->user_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->old_role }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->new_role }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $roleChange->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
