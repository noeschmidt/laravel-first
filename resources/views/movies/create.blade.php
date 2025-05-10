<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md flex flex-col justify-center gap-4">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create a Movie
            </h2>
            <a href="{{ route('movie.index') }}"
                class="text-indigo-600 mx-auto hover:text-indigo-900 px-3 py-1 border border-indigo-600 rounded hover:bg-indigo-50">
                Go Back to movies
            </a>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('movie.store') }}" class="space-y-6" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="poster">Poster du film</label>
                        <input type="file" name="poster" id="poster"
                            class="form-control @error('poster') is-invalid @enderror" accept="image/*">
                        @error('poster')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <div class="mt-1">
                            <x-input type="text" name="title" id="title" placeholder="Enter title" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <div class="mt-1">
                            <x-input type="number" name="year" id="year" placeholder="Enter year" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>

                    <div>
                        <label for="director_id" class="block text-sm font-medium text-gray-700">Director</label>
                        <div class="mt-1">
                            <select name="director_id" id="director_id" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($directors as $director)
                                    <option value="{{ $director->id }}">
                                        {{ $director->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
                        <div class="mt-1">
                            <select name="country_id" id="country_id" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Movie
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
