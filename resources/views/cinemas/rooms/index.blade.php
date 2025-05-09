<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Rooms for {{ $cinema->name }}</h1>
                <div class="mt-4">
                    @can('create', \App\Models\Room::class)
                    <a href="{{ route('cinema.room.create', $cinema->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Add New Room
                    </a>
                    @endcan
                    <a href="{{ route('cinema.show', $cinema->id) }}"
                        class="ml-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Back to Cinema Details
                    </a>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-amber-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Room Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Capacity
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Loop through rooms will be added here by the controller --}}
                            @forelse ($rooms as $room)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $room->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $room->capacity }} seats</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            {{-- Link to manage showtimes for this room --}}
                                            <a href="{{ route('room.showtime.index', $room->id) }}"
                                                class="text-blue-600 hover:text-blue-900 px-3 py-1 border border-blue-600 rounded hover:bg-blue-50">
                                                Showtimes
                                            </a>
                                            {{-- Edit link uses the shallow route 'room.edit' --}}
                                            @can('update', $room)
                                            <a href="{{ route('room.edit', $room->id) }}"
                                                class="text-amber-600 hover:text-amber-900 px-3 py-1 border border-amber-600 rounded hover:bg-amber-50">
                                                Edit
                                            </a>
                                            @endcan
                                            {{-- Delete form uses the shallow route 'room.destroy' --}}
                                            @can('delete', $room)
                                            <form action="{{ route('room.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50">
                                                    Delete
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        No rooms found for this cinema yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

             <div class="mt-4">
                {{-- Pagination links if needed --}}
                 {{-- $rooms->links() --}}
            </div>
        </div>
    </div>
</x-guest-layout> 