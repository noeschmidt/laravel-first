<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Artists List</h1>
                @auth
                    <div class="mt-4">
                        <a href="{{ route('artist.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            + Add New Artist
                        </a>
                    </div>
                @endauth
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-amber-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Photo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Last Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    First Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Birth Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Country
                                </th>
                                @auth
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Actions
                                </th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($artists as $artist)
                                <tr>
                                    <td class="px-2 py-4 whitespace-nowrap">
                                        @if ($artist->actor_path)
                                            <img src="{{ asset('storage/' . $artist->actor_path) }}"
                                                alt="{{ $artist->name }} {{ $artist->firstname }}" class="rounded w-24 h-32 object-cover shadow">
                                        @else
                                            <div class="bg-gray-200 w-24 h-32 flex items-center justify-center rounded">
                                                <span class="text-gray-500">No photo</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('artist.show', $artist->id) }}"
                                            class="text-sm font-medium text-gray-900">{{ $artist->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $artist->firstname }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ $artist->birthdate ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ $artist->country->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    @auth
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            @can('update', $artist)
                                            <a href="{{ route('artist.edit', $artist->id) }}"
                                                class="text-amber-600 hover:text-amber-900 px-3 py-1 border border-amber-600 rounded hover:bg-amber-50">
                                                Edit
                                            </a>
                                            @endcan
                                            @can('delete', $artist)
                                            <a href="{{ route('artist.destroy', $artist->id) }}"
                                                class="text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50 delete">
                                                Delete
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $artists->links() }}
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.delete').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                if (confirm('Are you sure you want to delete this artist?')) {
                    fetch(event.target.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token
                        },
                        method: 'DELETE',
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            alert('Error deleting artist');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting artist');
                    });
                }
            });
        });
    });
</script>
