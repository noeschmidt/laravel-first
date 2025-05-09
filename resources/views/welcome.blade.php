<x-guest-layout>

    <x-slot name="slot">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-4 text-3xl font-bold text-center">Welcome to Your Movie Guide!</h1>
            <p class="mb-8 text-lg text-center text-[#706f6c] dark:text-[#A1A09A]">Discover movies, find cinemas, and check showtimes near you.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <h2 class="text-xl font-semibold mb-2">Movies</h2>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Browse our extensive collection of films.</p>
                    <a href="{{ route('movie.index') }}" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-200">View Movies</a>
                </div>

                <div class="text-center">
                    <h2 class="text-xl font-semibold mb-2">Cinemas</h2>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Find cinemas and their locations.</p>
                    <a href="{{ route('cinema.index') }}" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-200">Find Cinemas</a>
                </div>

                <div class="text-center">
                    <h2 class="text-xl font-semibold mb-2">Showtimes</h2>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Check showtimes for movies at your favorite cinemas.</p>
                    <a href="{{ route('showtimes.index') }}" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-200">View Showtimes</a>
                </div>
            </div>
        </div>
       
    </x-slot>

</x-guest-layout>

