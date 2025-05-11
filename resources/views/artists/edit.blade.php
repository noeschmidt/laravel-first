<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Edit Artist
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('artist.update', $artist->id) }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="acteur-photo" class="block text-sm font-medium text-gray-700 mb-1">Photo de l'acteur</label>
                        @if ($artist->actor_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $artist->actor_path) }}" alt="{{ $artist->name }} {{ $artist->firstname }}"
                                    class="h-40"  accept="image/*">
                            </div>
                        @endif
                        <input type="file" name="acteur-photo" id="acteur-photo"
                            class="form-control @error('acteur-photo') is-invalid @enderror">
                        @error('acteur-photo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Last Name
                        </label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" value="{{ $artist->name }}" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">
                            First Name
                        </label>
                        <div class="mt-1">
                            <input type="text" name="firstname" id="firstname" value="{{ $artist->firstname }}"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-gray-700">
                            Birth Year
                        </label>
                        <div class="mt-1">
                            <input type="number" min="1902" max="2023" step="1" name="birthdate"
                                id="birthdate" placeholder="Enter birth year" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700">
                            Country
                        </label>
                        <div class="mt-1">
                            <select name="country_id" id="country_id" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $country->id == $artist->country_id ? 'selected="selected"' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('artist.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Artist
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
