<main class="h-full pb-16 overflow-y-auto">

    <div class="px-1 py-1 w-auto">
        <h3 class="mb-2 pt-4 text-md font-semibold text-gray-600"> Some interesting numbers from this list </h3> <br />
    </div>
    <div class="grid gap-3 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- # Of Programs Card -->
        <div
            class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs"
        >
            <div
                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600"
                >
                    # of Programs
                </p>
                <p
                    class="text-lg font-semibold text-gray-900"
                >
                    {{ $num_documents }}
                </p>
            </div>
        </div>

        <!-- Cost of Tuition Card -->
        <div
            class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs"
        >
            <div
                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600"
                >
                    Average Cost of Tuition
                </p>
                <p
                    class="text-lg font-semibold text-gray-700"
                >
                    $ {{ $average_cost }}
                </p>
            </div>
        </div>

        <!-- # of Providers Card -->
        <div
            class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs"
        >
            <div
                class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full "
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                    ></path>
                </svg>
            </div>
            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600 "
                >
                    # Of Providers
                </p>
                <p
                    class="text-lg font-semibold text-gray-700 "
                >
                    {{ $providers->count() }}
                </p>
            </div>
        </div>

        <!-- # of Cities Card -->
        <div
            class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs"
        >
            <div
                class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full "
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600"
                >
                    # Of Cities
                </p>
                <p
                    class="text-lg font-semibold text-gray-700"
                >
                    {{ $cities->count()  }}
                </p>
            </div>
        </div>

</div>
