<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $artist->name }} {{ $artist->firstname }}</h1>
                        <p class="mt-1 text-lg text-gray-600">Born in {{ $artist->birthdate }}</p>
                        <p class="text-gray-700">
                            Country: <span class="font-medium">{{ $artist->country->name ?? 'Unknown' }}</span>
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('artist.edit', $artist->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit Artist
                        </a>
                        <a href="{{ route('artist.destroy', $artist->id) }}"
                            class="text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50 delete">
                            Delete
                        </a>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Directed Movies</h2>
                <div class="space-y-3 mb-6">
                    @if($directedMovies->count() > 0)
                        @foreach($directedMovies as $movie)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $movie->title }} ({{ $movie->year }})
                                    </p>
                                </div>
                                <a href="{{ route('movie.show', $movie->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    View
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No directed movies found.</p>
                    @endif
                </div>

                <h2 class="text-xl font-semibold text-gray-800 mb-4">Acted In</h2>
                <div class="space-y-3">
                    @if($actedInMovies->count() > 0)
                        @foreach($actedInMovies as $movie)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $movie->title }} ({{ $movie->year }})
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Role: {{ $movie->pivot->role_name }}
                                    </p>
                                </div>
                                <a href="{{ route('movie.show', $movie->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    View
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No acting roles found.</p>
                    @endif
                </div>
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

                if (confirm('Are you sure you want to delete this artist?')) {
                    fetch(event.target.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token
                        },
                        method: 'DELETE',
                    }).then(response => {
                        if (response.ok) {
                            window.location.pathname = '/artists';
                        }
                    });
                }
            });
        });
    });
</script>
