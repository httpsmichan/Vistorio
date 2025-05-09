<x-app-layout>
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-64 bg-[#27374D] text-white top-0 left-0 h-auto z-20">
            <h3 class="text-1xl font-bold m-5 text-center">VISTORIO</h3>
            <nav class="space-y-2 ml-5">
                <a href="{{ route('admin') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
                    <i class="fas fa-home"></i>
                    <span class="hidden md:inline ">Dashboard</span>
                </a>
                <a href="{{ route('visit.history') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#1e2c3b] transition">
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
        <div class="bg-white flex-1 py-5 px-5">
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

            <div class="pt-5 flex flex-col lg:flex-row gap-6">
                <!-- Recommended Properties -->
                <div class="bg-white rounded-t-md shadow w-full lg:w-2/3">
                    <div class="bg-[#0f766e] text-white px-4 py-2 font-bold flex justify-between items-center rounded-t-md">
                        <span>Recommended Properties</span>
                        <a href="#" class="text-sm underline text-white hover:text-gray-200">View All</a>
                    </div>
                    <div class="p-4 space-y-4 text-gray-700">
                        @foreach ([
                            ['img' => 'images/house1.jpg', 'price' => '$875,000', 'address' => '567 Park Avenue, Unit 802', 'details' => '2 Bed | 2 Bath | 1,250 sqft'],
                            ['img' => 'images/house2.jpg', 'price' => '$1,250,000', 'address' => '321 Skyline Blvd', 'details' => '4 Bed | 3 Bath | 2,800 sqft'],
                            ['img' => 'images/house3.jpg', 'price' => '$695,000', 'address' => '842 Riverside Drive', 'details' => '3 Bed | 2 Bath | 1,850 sqft'],
                        ] as $property)
                            <div class="flex items-start gap-4">
                                <img src="{{ $property['img'] }}" alt="Property" class="w-32 h-24 object-cover rounded-md">
                                <div>
                                    <div class="text-lg font-semibold text-gray-800">{{ $property['price'] }}</div>
                                    <div class="text-gray-700">{{ $property['address'] }}</div>
                                    <div class="text-sm text-gray-500">{{ $property['details'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Market Trends -->
                <div class="bg-white rounded-t-md shadow w-full lg:w-1/3">
                    <div class="bg-[#0f766e] text-white px-4 py-2 font-bold rounded-t-md">Market Trends</div>
                    <div class="p-4 space-y-4 text-gray-700">
                        @foreach ([
                            ['icon' => 'dollar-sign', 'title' => 'Average Home Price', 'value' => '$825,000', 'trend' => '↑ 3.5%', 'trendColor' => 'green'],
                            ['icon' => 'clock', 'title' => 'Days on Market', 'value' => '28 days', 'trend' => '↓ 12%', 'trendColor' => 'red'],
                            ['icon' => 'percent', 'title' => 'Mortgage Rates', 'value' => '4.25%', 'trend' => '↑ 0.25%', 'trendColor' => 'green'],
                            ['icon' => 'home', 'title' => 'New Listings', 'value' => '152', 'trend' => '↑ 8%', 'trendColor' => 'green'],
                        ] as $trend)
                            <div class="flex items-start gap-3">
                                <i class="fas fa-{{ $trend['icon'] }} text-gray-500 mt-1"></i>
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $trend['title'] }}</div>
                                    <div class="text-sm text-gray-600">
                                        {{ $trend['value'] }}
                                        <span class="text-{{ $trend['trendColor'] }}-500">{{ $trend['trend'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Most Viewed Section -->
            <div class="bg-white rounded-t-md shadow w-full mt-6">
                <div class="bg-[#0f766e] text-white px-4 py-2 font-bold flex justify-between items-center rounded-t-md">
                    <span>Most Viewed</span>
                    <a href="#" class="text-sm underline text-white hover:text-gray-200">View All</a>
                </div>
                <div class="p-4 space-y-4 text-gray-700">
                    @foreach ([
                        ['img' => 'images/house1.jpg', 'price' => '$875,000', 'address' => '567 Park Avenue, Unit 802', 'details' => '2 Bed | 2 Bath | 1,250 sqft'],
                        ['img' => 'images/house2.jpg', 'price' => '$1,250,000', 'address' => '321 Skyline Blvd', 'details' => '4 Bed | 3 Bath | 2,800 sqft'],
                        ['img' => 'images/house3.jpg', 'price' => '$695,000', 'address' => '842 Riverside Drive', 'details' => '3 Bed | 2 Bath | 1,850 sqft'],
                    ] as $property)
                        <div class="flex items-start gap-4">
                            <img src="{{ $property['img'] }}" alt="Property" class="w-32 h-24 object-cover rounded-md">
                            <div>
                                <div class="text-lg font-semibold text-gray-800">{{ $property['price'] }}</div>
                                <div class="text-gray-700">{{ $property['address'] }}</div>
                                <div class="text-sm text-gray-500">{{ $property['details'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
