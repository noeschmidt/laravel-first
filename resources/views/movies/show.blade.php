<x-guest-layout>
    <h1>{{ $movie->title }}</h1>
    <p>{{ $movie->year }}</p>
    <p>{{ $movie->director->firstname }} {{ $movie->director->name }} </p>

    <form method="POST" action="{{ route('movie.attach', $movie->id) }}">
        {{ csrf_field() }}
        <p>
            <label for="actor_id">Actor</label>
            <select name="actor_id" id="actor_id" required>
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}">
                        {{ $artist->firstname }} {{ $artist->lastname }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="role">Rôle</label>
            <input type="text" name="role" id="role" value="" required />
        </p>
        <button type="submit">Add</button>
    </form>
</x-guest-layout>
