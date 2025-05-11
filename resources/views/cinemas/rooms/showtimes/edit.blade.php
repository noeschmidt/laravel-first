<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Edit Showtime
            </h2>
            <p class="mt-1 text-center text-sm text-gray-600">
                Room: {{ $showtime->room->name }} (Cinema: {{ $showtime->room->cinema->name }})
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg"> {{-- Increased max-w --}}
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('showtime.update', $showtime->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="movie_id" class="block text-sm font-medium text-gray-700">Movie *</label>
                        <select id="movie_id" name="movie_id" required
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('movie_id') border-red-500 @enderror">
                            <option value="">Select a movie</option>
                            @foreach ($movies as $movie)
                                <option value="{{ $movie->id }}" {{ old('movie_id', $showtime->movie_id) == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }} ({{ $movie->year }})
                                </option>
                            @endforeach
                        </select>
                         @error('movie_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time *</label>
                        {{-- Format datetime for the input value --}}
                        <input type="datetime-local" id="start_time" name="start_time" required value="{{ old('start_time', $showtime->start_time->format('Y-m-d\TH:i')) }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('start_time') border-red-500 @enderror">
                         @error('start_time')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                     <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time *</label>
                        <input type="datetime-local" id="end_time" name="end_time" required value="{{ old('end_time', $showtime->end_time->format('Y-m-d\TH:i')) }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('end_time') border-red-500 @enderror">
                         @error('end_time')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="room_id" value="{{ $showtime->room_id }}">

                    <div class="flex items-center justify-between">
                        <a href="{{ route('room.showtime.index', $showtime->room_id) }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Showtime
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout> 