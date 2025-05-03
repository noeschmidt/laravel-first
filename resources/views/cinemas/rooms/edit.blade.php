<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Edit Room: {{ $room->name }}
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Cinema: {{ $room->cinema->name }}
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                {{-- Form posts to the shallow route 'room.update' --}}
                <form method="POST" action="{{ route('room.update', $room->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Room Name *
                        </label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" required value="{{ old('name', $room->name) }}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700">
                            Capacity *
                        </label>
                        <div class="mt-1">
                            <input type="number" name="capacity" id="capacity" required min="1" value="{{ old('capacity', $room->capacity) }}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('capacity') border-red-500 @enderror">
                             @error('capacity')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Hidden field for cinema_id might not be strictly necessary if not updating it, but good practice --}}
                    <input type="hidden" name="cinema_id" value="{{ $room->cinema_id }}">

                    <div class="flex items-center justify-between">
                        {{-- Link back to the rooms index for the parent cinema --}}
                        <a href="{{ route('cinema.room.index', $room->cinema_id) }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout> 