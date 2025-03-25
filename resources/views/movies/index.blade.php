<x-guest-layout>
    <table class="table table-striped table-centered bg-amber-50 m-8">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Year') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->year }}</td>

                    <td class="table-action"><a href="{{ route('movie.edit', $movie->id) }}">{{ __('Edit') }}</a>
                    </td>
                    <td>
                        <a href="{{ route('movie.destroy', $movie->id) }}"
                            class="delete bg-red-200 text-red-600 p-2 rounded-lg border border-red-600">
                            {{ __('Delete') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="w-full flex">
        {{ $movies->links() }}
        <div>
</x-guest-layout>

<script>
    // Récupération du token
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Ajout des événements
    document.querySelectorAll('.delete').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();

            // Requête AJAX de suppression
            fetch(event.target.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                },

                method: 'DELETE',
            });
        })
    });
</script>
