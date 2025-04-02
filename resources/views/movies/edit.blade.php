<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Edit Movie</h1>
                <p class="mt-2 text-sm text-gray-600">Update the movie details below</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-8">
                <form method="POST" action="{{ route('movie.update', $movie->id) }}" class="space-y-6"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Poster du
                            film</label>
                        @if ($movie->poster_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}"
                                    class="h-40">
                            </div>
                        @endif
                        <input type="file" name="poster" id="poster"
                            class="form-control @error('poster') is-invalid @enderror">
                        @error('poster')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <x-input type="text" name="title" id="title" placeholder="Enter title"
                            value="{{ $movie->title }}" required class="w-full" />
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <x-input type="number" name="year" id="year" placeholder="Enter year"
                            value="{{ $movie->year }}" required class="w-full" />
                    </div>

                    <div>
                        <label for="director_id" class="block text-sm font-medium text-gray-700 mb-1">Director</label>
                        <select name="director_id" id="director_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($directors as $director)
                                <option value="{{ $director->id }}"
                                    {{ $director->id == $movie->director_id ? 'selected' : '' }}>
                                    {{ $director->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <select name="country_id" id="country_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $country->id == $movie->country_id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('movie.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <x-button type="submit" class="px-4 py-2">
                            Update Movie
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
