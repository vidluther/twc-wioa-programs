<!--left side navigation -->
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <div class="sm:w-1/3 md:1/4 w-full flex-shrink flex-grow-0 p-4">
        <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
            <ul class="flex sm:flex-col overflow-hidden content-center justify-between">
                <li class="py-2 hover:bg-indigo-300 rounded">
                    <a class="truncate" href="/">
                        <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/home.svg" class="w-7 sm:mx-2 mx-4 inline" />
                        <span class="hidden sm:inline">Home</span>
                    </a>
                </li>
                <li class="py-2 hover:bg-indigo-300 rounded">
                    <a class="" href="/about">
                        <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/information-circle.svg" class="w-7 sm:mx-2 mx-4 inline" /> <span class="hidden sm:inline">About</span>
                    </a>
                </li>
                <li class="py-2 hover:bg-indigo-300 rounded">
                    <a class="" href="https://www.twc.texas.gov/" target="new">
                        <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/external-link.svg" class="w-7 sm:mx-2 mx-4 inline" /> <span class="hidden sm:inline">Workforce Commission</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bg-gray-50 rounded-xl border my-3 w-full">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:py-12 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h3 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    <span class="block text-indigo-600 overflow-ellipsis">Search</span>
                </h3>
            </div>
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:py-12 lg:px-8 lg:flex lg:items-center lg:justify-between">
                @livewire('searchform')
            </div>
        </div>
    </div>
    <!-- end of left side navigation -->
