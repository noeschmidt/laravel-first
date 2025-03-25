<x-guest-layout>
    <form method="POST" action="{{ route('artist.store') }}">
        {{ csrf_field() }}
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="" required />
        </p>
        <p>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname" value="" required />
        </p>
        <p>
            <select name="country_id" id="country_id" required>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ $country->id == $artist->country_id ? 'selected="selected"' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <button type="submit">Create</button>
    </form>
</x-guest-layout>
