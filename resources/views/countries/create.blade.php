<x-guest-layout>
    <form method="POST" action="{{ route('country.store') }}">
        {{ csrf_field() }}
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="" required />
        </p>

        <button type="submit">Create</button>
    </form>
</x-guest-layout>
