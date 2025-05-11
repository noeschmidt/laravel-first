<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                       
                        <h1 class="text-3xl font-bold text-gray-900">{{ $cinema->name }}</h1>
                        <p class="mt-1 text-lg text-gray-600">{{ $cinema->address }}</p>
                    </div>
                    @can('update', $cinema)
                    <div>
                        <a href="{{ route('cinema.edit', $cinema->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit Cinema
                        </a>
                        <a href="{{ route('cinema.room.index', $cinema->id) }}"
                           class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Manage Rooms
                        </a>
                        <a href="{{ route('cinema.destroy', $cinema->id) }}"
                            class="ml-2 text-red-600 hover:text-red-900 px-3 py-1 border border-red-600 rounded hover:bg-red-50 delete">
                            Delete
                        </a>
                    </div>
                    @endcan
                </div>
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
                            return response.json();
                        } else {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Error deleting cinema');
                            }).catch(() => {
                                throw new Error('Error deleting cinema (Status: ' + response.status + ')');
                            });
                        }
                    })
                    .then(data => {
                        console.log(data.message);
                        window.location.pathname = '/cinema';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert(error.message || 'Error deleting cinema');
                    });
                }
            });
        });
    });
</script>