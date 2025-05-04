<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Movies List</h1>
                @can('create', Movie::class)
                <div class="mt-4">
                    <a href="{{ route('movie.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Add New Movie
                    </a>
                </div>
                @endcan
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Poster
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Year
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Director
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Country
                                </th>
                                @can('delete', Movie::class)
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($movies as $movie)
                                <tr>
                                    <td class="px-2 py-4 whitespace-nowrap">
                                    @if ($movie->poster_path)
                                        <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}" class="rounded w-24 h-32 object-cover shadow">
                                    @else
                                        <div class="bg-gray-200 w-24 h-32 flex items-center justify-center rounded">
                                            <span class="text-gray-500">No poster</span>
                                        </div>
                                    @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('movie.show', $movie->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">{{ $movie->title }}
                </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $movie->year }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">
                        {{ $movie->director?->name ?? 'No director found' }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">
                        {{ $movie->country?->name ?? 'No Country Associated' }}
                    </div>
                </td>
                @can('delete', Movie::class)
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('movie.edit', $movie->id) }}"
                            class="text-indigo-600 hover:text-indigo-900 px-3 py-1 border border-indigo-600 rounded hover:bg-indigo-50">
                            Edit
                        </a>
                        <a href="{{ route('movie.destroy', $movie->id) }}"
                            class="text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50 delete">
                            Delete
                        </a>
                    </div>
                </td>
                @endcan
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $movies->links() }}
        </div>
    </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.delete').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                if (confirm('Are you sure you want to delete this movie?')) {
                    fetch(event.target.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token
                        },
                        method: 'DELETE',
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
