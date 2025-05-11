<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto"> 
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">All Scheduled Showtimes</h1>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Movie
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cinema
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Room
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Start Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    End Time
                                </th>
                                @can('update', Showtime::class)
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($showtimes as $showtime)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('movie.show', $showtime->movie->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $showtime->movie->title ?? 'N/A' }}
                                            </a>
                                        </div>
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <a href="{{ route('cinema.show', $showtime->room->cinema->id) }}" class="text-gray-600 hover:text-gray-800">
                                                {{ $showtime->room->cinema->name ?? 'N/A' }}
                                            </a>
                                        </div>
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <a href="{{ route('room.show', $showtime->room->id) }}" class="text-gray-600 hover:text-gray-800">
                                                {{ $showtime->room->name ?? 'N/A' }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $showtime->start_time }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $showtime->end_time }}</div>
                                    </td>
                                    @can('update', $showtime)
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                         <a href="{{ route('showtime.edit', $showtime->id) }}"
                                            class="text-amber-600 hover:text-amber-900 px-3 py-1 border border-amber-600 rounded hover:bg-amber-50">Edit</a>
                                        @can('delete', $showtime)
                                            <form action="{{ route('showtime.destroy', $showtime->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this showtime?');" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        No showtimes found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

             <div class="mt-4">
                 {{ $showtimes->links() }}
            </div>
        </div>
    </div>
</x-guest-layout> 