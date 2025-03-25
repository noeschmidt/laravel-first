<x-guest-layout>

    <form method="POST" action="{{ route('movie.update', $movie->id) }}"
        class="mx-auto max-w-2xl flex place-items-center justify-center flex-col h-screen gap-8">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h1 class="text-2xl font-bold">Create a movie</h1>
        <p class="flex flex-col gap-2">
            <label for="title">Title</label>
            <x-input type="text" name="title" id="title" placeholder="Enter title" value="{{ $movie->title }}"
                required />

        </p>
        <p class="flex flex-col gap-2">
            <label for="year">Year</label>
            <x-input type="number" name="year" id="year" placeholder="Enter year" value="{{ $movie->year }}"
                required />
        </p>
        <p class="flex flex-col gap-2 w-full">
            <label for="year">Director</label>
            <select name="director_id" id="director_id" required class="w-full">
                @foreach ($directors as $director)
                    <option value="{{ $director->id }}"
                        {{ $director->id == $movie->director_id ? 'selected="selected"' : '' }}>
                        {{ $director->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p class="flex flex-col gap-2 w-full">
            <label for="year">Country</label>
            <select name="country_id" id="country_id" required class="w-full">
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ $country->id == $movie->country_id ? 'selected="selected"' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <x-button type="submit">Edit</x-button>
    </form>
</x-guest-layout>
