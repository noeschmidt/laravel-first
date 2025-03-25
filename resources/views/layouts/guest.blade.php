<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <header class="bg-indigo-600 shadow-md">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex space-x-8">
                    <a href="{{ route('artist.index') }}"
                        class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        Artists
                    </a>

                    <a href="{{ route('movie.index') }}"
                        class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm3 2h6v4H7V5zm8 8v2h1v-2h-1zm-2-8h1V5h-1v2zm2 4h1V9h-1v2zm0 4h1v-2h-1v2zm-4 0h1v-2h-1v2zm-4 0h1v-2H7v2zm-1-4h1V9H6v2zm0-4h1V5H6v2zm-1 8h1v-2H5v2z"
                                clip-rule="evenodd" />
                        </svg>
                        Movies
                    </a>

                    <a href="{{ route('country.index') }}"
                        class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Countries
                    </a>
                </div>

                <div class="flex items-center">
                    <span class="text-white text-sm font-medium">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>
        </nav>
    </header>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}

    </div>

    @if (session('ok'))
        <div class="bg-sky-100 border-l-4 border-sky-500 text-sky-700 p-4" role="alert">
            <p>Message</p>
            <p>{{ session('ok') }}</p>
        </div>
    @endif


    @livewireScripts
</body>

</html>
