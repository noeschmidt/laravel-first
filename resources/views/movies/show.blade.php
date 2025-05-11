<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                    @if ($movie->poster_path)
                                        <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}" class="rounded w-48 h-64 object-cover shadow">
                                    @else
                                        <img src="{{ asset('images/default-movie-image.png') }}" alt="No poster available" class="rounded w-48 h-64 object-cover shadow bg-gray-200">
                                    @endif
                        <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $movie->title }}</h1>
                        <p class="mt-1 text-lg text-gray-600">{{ $movie->year }}</p>
                        <p class="text-gray-700">
                            Directed by: <span class="font-medium">{{ $movie->director->firstname }}
                                {{ $movie->director->name }}</span>
                        </p>
                    </div>
                    @can('update', $movie)
                    <div class="flex items-center gap-2">
                        <a href="{{ route('movie.edit', $movie->id) }}"
                            class="inline-flex items-center px-4 py-2 text-nowrap border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit Movie
                        </a>
                        <a href="{{ route('movie.destroy', $movie->id) }}"
                            class="text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50 delete">
                            Delete
                        </a>
                    </div>
                    @endcan
                </div>
            </div>

            <div class="px-6 py-5">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Cast</h2>

                <div class="space-y-3 mb-6">
                    @foreach ($movie->actors as $artist)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $artist->firstname }} {{ $artist->name }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Role: {{ $artist->pivot->role_name }}
                                </p>
                            </div>
                            @can('delete', $movie)
                            <a class="text-red-600 hover:text-red-800 delete text-sm font-medium"
                                href="{{ route('movie.detach', ['movie' => $movie->id, 'artist' => $artist->id]) }}">
                                Remove
                            </a>
                            @endcan
                        </div>
                    @endforeach
                </div>
                @can('update', $movie)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add Actor to Cast</h3>
                    <form method="POST" action="{{ route('movie.attach', $movie->id) }}">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="actor_id" class="block text-sm font-medium text-gray-700">Actor</label>
                                <select name="actor_id" id="actor_id" required
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">


                                    @foreach ($availableArtists as $artist)
                                        <option value="{{ $artist->id }}">
                                            {{ $artist->firstname }} {{ $artist->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <input type="text" name="role" id="role" required placeholder="Enter role"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="sm:col-span-6">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add Actor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.detach').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                if (confirm('Are you sure you want to detach this actor?')) {
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
                            // A revoir
                            window.location.pathname = '/';
                        }
                    });
                }
            });
        });
    });
</script>
