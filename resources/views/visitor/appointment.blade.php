<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book an Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Display User's Appointments Table -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
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

            <!-- Appointment Form -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-500">{{ session('success') }}</div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Name:</label>
                        <input type="text" name="name" class="w-full border rounded p-2" required>
                    </div>

                    <h1>Contact Information</h1>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email:</label>
                        <input type="email" name="email" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Phone Number:</label>
                        <input type="tel" name="phone_number" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Purpose of Visit:</label>
                        <textarea name="purpose" class="w-full border rounded p-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Preferred Date & Time:</label>
                        <input type="datetime-local" name="preferred_date_time" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Host (Who you’re meeting):</label>
                        <input type="text" name="host" class="w-full border rounded p-2" required>
                    </div>

                    <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">
                        Book Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
