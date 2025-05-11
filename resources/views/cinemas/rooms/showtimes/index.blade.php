<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Showtimes for {{ $room->name }}</h1>
                <p class="mt-1 text-lg text-gray-600">Cinema: {{ $room->cinema->name }}</p>
                <div class="mt-4">
                    <a href="{{ route('room.showtime.create', $room->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Add New Showtime
                    </a>
                    <a href="{{ route('cinema.room.index', $room->cinema_id) }}"
                        class="ml-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Back to Room List
                    </a>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                                    Movie
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                                    Start Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                                    End Time
                                </th>
                                @auth
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-blue-800 uppercase tracking-wider">
                                    Actions
                                </th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($showtimes as $showtime)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $showtime->movie->title ?? 'Movie not found' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- Format the start time --}}
                                        <div class="text-sm text-gray-500">{{ $showtime->start_time }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- Format the end time --}}
                                        <div class="text-sm text-gray-500">{{ $showtime->end_time }}</div>
                                    </td>
                                    @auth
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                          
                                            <a href="{{ route('showtime.edit', $showtime->id) }}"
                                                class="text-amber-600 hover:text-amber-900 px-3 py-1 border border-amber-600 rounded hover:bg-amber-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('showtime.destroy', $showtime->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this showtime?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endauth
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        No showtimes scheduled for this room yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

             <div class="mt-4">
                 {{-- $showtimes->links() --}}
            </div>
        </div>
    </div>
</x-guest-layout> 