<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Add New Cinema
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Fill in the details below to create a new cinema
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('cinema.store') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Name *
                        </label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Enter cinema name">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">
                            Address *
                        </label>
                        <div class="mt-1">
                            <input type="text" name="address" id="address" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Enter cinema address">
                        </div>
                    </div>

                   

                    <div class="flex items-center justify-between">
                        <a href="{{ route('cinema.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Cinema
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>