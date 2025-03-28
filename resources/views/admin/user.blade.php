<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('All Users') }}</h3>
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="w-full bg-gray-100 border-b">
                                <th class="py-2 px-4 border">ID</th>
                                <th class="py-2 px-4 border">Name</th>
                                <th class="py-2 px-4 border">Email</th>
                                <th class="py-2 px-4 border">Role</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b">
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
            </div>
        </div>
    </div>
</x-app-layout>