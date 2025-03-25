<x-guest-layout>
    <form method="POST" action="{{ route('movie.store') }}">
        {{ csrf_field() }}
        <p>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="" required />
        </p>
        <p>
            <label for="year">Year</label>
            <input type="number" name="year" id="year" value="" required />
        </p>
        <button type="submit">Create</button>
    </form>
</x-guest-layout>
