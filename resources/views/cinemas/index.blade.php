<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Cinemas List</h1>
                @auth
                <div class="mt-4">
                    <a href="{{ route('cinema.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Add New Cinema
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
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                    Address
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
                            @foreach ($cinemas as $cinema)
                                <tr>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('cinema.show', $cinema->id) }}"
                                            class="text-sm font-medium text-gray-900">{{ $cinema->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $cinema->address }}</div>
                                    </td>
                                    @auth
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            @can('update', $cinema)
                                                <a href="{{ route('cinema.edit', $cinema->id) }}"
                                                    class="text-amber-600 hover:text-amber-900 px-3 py-1 border border-amber-600 rounded hover:bg-amber-50">
                                                    Edit
                                                </a>
                                            @endcan
                                            <a href="{{ route('cinema.room.index', $cinema->id) }}"
                                                class="text-blue-600 hover:text-blue-900 px-3 py-1 border border-blue-600 rounded hover:bg-blue-50">
                                                 Manage Rooms
                                            </a>
                                            @can('delete', $cinema)
                                                <a href="{{ route('cinema.destroy', $cinema->id) }}"
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
                {{ $cinemas->links() }}
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

                if (confirm('Are you sure you want to delete this cinema?')) {
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
                            alert('Error deleting cinema');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting cinema');
                    });
                }
            });
        });
    });
</script>