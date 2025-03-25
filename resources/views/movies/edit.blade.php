<x-guest-layout>
    <form method="POST" action="{{ route('movie.update', $movie->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <p>
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}" required />
        </p>
        <p>
            <label for="year">{{ __('Year') }}</label>
            <input type="number" name="year" id="year" value="{{ $movie->year }}" required />
        </p>

        <button type="submit">Edit</button>
    </form>
</x-guest-layout>
