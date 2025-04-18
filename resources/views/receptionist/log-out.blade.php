<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visitor Log-out') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex space-x-4">
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('receptionist') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Dashboard</a></li>
                        <li><a href="{{ route('walk-in.create') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Walk-in Registration</a></li>
                        <li><a href="{{ route('log-out.search') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Visitor Log-out</a></li>
                        <li><a href="{{ route('receptionist.appointments.lookup') }}" class="block px-4 py-2 bg-white rounded transition">Appointment Lookup</a></li>
                        <li><a href="{{ route('receptionist.notifications') }}" class="block px-4 py-2 bg-white hover:bg-gray-200 rounded transition">Notifications</a></li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="flex-1 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Current Visitors</h3>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input id="searchBar" type="text" class="px-4 py-2 w-full border rounded" placeholder="Enter Visitor #, Name, or Host" oninput="searchVisitors()">
                    </div>

                    <!-- Visitor Log-out Table -->
                    @if(isset($visitors) && $visitors->count() > 0)
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">Visitor #</th>
                                    <th class="border p-2">Full Name</th>
                                    <th class="border p-2">Host</th>
                                    <th class="border p-2">Visit Time</th>
                                    <th class="border p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="visitorTable">
                                @foreach ($visitors as $visitor)
                                    <tr class="visitor-item" data-visitor-number="{{ $visitor->visitor_number }}" data-full-name="{{ $visitor->full_name }}" data-host="{{ $visitor->host }}">
                                        <td class="border p-2">{{ $visitor->visitor_number }}</td>
                                        <td class="border p-2">{{ $visitor->full_name }}</td>
                                        <td class="border p-2">{{ $visitor->host }}</td>
                                        <td class="border p-2">{{ $visitor->visit_time }}</td>
                                        <td class="border p-2">
                                            @if($visitor->logged_out_at)
                                                <span class="text-green-600">Already Logged Out</span>
                                            @else
                                                <form method="POST" action="{{ route('log-out.update', $visitor->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-red-500 text-black px-3 py-1 rounded">
                                                        Log Out
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">No visitors found.</p>
                    @endif
                </div>
        </div>
    </div>

    <!-- Search Script -->
    <script>
        function searchVisitors() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let visitorItems = document.querySelectorAll('.visitor-item');
            
            visitorItems.forEach(item => {
                let visitorNumber = item.getAttribute('data-visitor-number').toLowerCase();
                let fullName = item.getAttribute('data-full-name').toLowerCase();
                let host = item.getAttribute('data-host').toLowerCase();

                if (visitorNumber.includes(searchQuery) || fullName.includes(searchQuery) || host.includes(searchQuery)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
