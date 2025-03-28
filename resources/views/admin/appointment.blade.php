<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display User's Appointments Table -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Your Appointments</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                            <th class="border border-gray-300 px-4 py-2">Purpose</th>
                            <th class="border border-gray-300 px-4 py-2">Preferred Date & Time</th>
                            <th class="border border-gray-300 px-4 py-2">Host</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $appointment->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $appointment->email }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $appointment->phone_number }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $appointment->purpose }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $appointment->preferred_date_time }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $appointment->host }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">No appointments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
