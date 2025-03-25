<x-guest-layout>
    <table class="table table-striped table-centered bg-amber-50 m-8">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Firstname') }}</th>
                <th>{{ __('Country') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artists as $artist)
                <tr>
                    <td>{{ $artist->name }}</td>
                    <td>{{ $artist->firstname }}</td>
                    <td>{{ $artist->country->name }}</td>
                    <td class="table-action"><a href="{{ route('artist.edit', $artist->id) }}">{{ __('Edit') }}</a>
                    </td>
                    <td>
                        <a href="{{ route('artist.destroy', $artist->id) }}"
                            class="delete bg-red-200 text-red-600 p-2 rounded-lg border border-red-600">
                            {{ __('Delete') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="w-full flex">
        {{ $artists->links() }}
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
