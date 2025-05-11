<x-guest-layout>

    <x-slot name="slot">
        <main class="bg-indigo-900">
        <div class="flex-1 px-6 pt-12 text-white">
            <h1 class="mb-4 text-3xl font-bold text-center">Welcome to NetFlux !</h1>
            <p class="mb-8 text-lg text-center text-neutral-100">Discover movies, find cinemas, and check showtimes near you.</p>
        </div>

        <div class="text-xs flex-1 p-6 ">
            <h2 class="mb-4 text-2xl font-bold text-white text-center">Latest Movies</h2>
            @if($latestMovies->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 ">
                    @foreach($latestMovies as $movie)
                        <div class="text-center p-4 bg-indigo-600 border border-indigo-500  rounded-lg">
                            <a href="{{ route('movie.show', $movie) }}" class="">
                                @if($movie->poster_path)
                                    <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }} poster" class="w-full h-64 object-cover rounded-md mb-2">
                                @else
                                    <div class="w-full h-64 bg-gray-300 rounded-md mb-2 flex items-center justify-center">
                                    <img src="{{ asset('images/default-movie-image.png') }}" alt="No poster available" class="rounded size-full object-cover shadow">
                                    </div>
                                @endif
                                <h3 class="text-lg font-semibold text-white">{{ $movie->title }}</h3>
                                <p class="text-sm text-neutral-200">{{ $movie->year }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-neutral-200">No movies to display at the moment.</p>
            @endif
        </div>

        <div class="text-xs flex-1 p-6 ">
            <h2 class="mb-4 text-2xl font-bold text-white text-center">Latest Artists</h2>
            @if($latestArtists->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                    @foreach($latestArtists as $artist)
                        <div class="text-center p-4 bg-indigo-600 border border-indigo-500 rounded-lg">
                             <a href="{{ route('artist.show', $artist) }}">
                                @if($artist->actor_path)
                                    <img src="{{ asset('storage/' . $artist->actor_path) }}" alt="{{ $artist->firstname }} {{ $artist->name }}" class="w-full h-64 object-cover rounded-md mb-2">
                                @else
                                    <div class="w-full h-64 bg-gray-300 rounded-md mb-2 flex items-center justify-center">
                                        <span class="text-gray-500">No Photo</span>
                                    </div>
                                @endif
                                <h3 class="text-lg font-semibold text-white">{{ $artist->firstname }} {{ $artist->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-neutral-200">No artists to display at the moment.</p>
            @endif
        </div>

        <div class="text-xs flex-1 p-6 ">
            <h2 class="mb-4 text-2xl font-bold text-white text-center">Upcoming Showtimes</h2>
            @if($upcomingShowtimes->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($upcomingShowtimes as $showtime)
                        <div class="p-4 bg-indigo-600 border border-indigo-500 rounded-lg">
                            <h3 class="text-lg font-semibold text-white">{{ $showtime->movie->title }}</h3>
                            <p class="text-sm text-neutral-200">
                                {{ $showtime->room->cinema->name }} - Room {{ $showtime->room->room_number }}
                            </p>
                            <p class="text-sm text-neutral-200">
                                Starts: {{ $showtime->start_time }}
                            </p>
                             <a href="{{ route('room.showtime.index', $showtime->room_id) }}" class="mt-2 inline-block text-indigo-200 hover:text-indigo-300 font-semibold">View Room Showtimes</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-neutral-200">No upcoming showtimes.</p>
            @endif
        </div>
        </main>
    </x-slot>

</x-guest-layout>

