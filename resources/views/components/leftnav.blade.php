<!--left side navigation -->
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <div class="sm:w-1/3 md:1/4 w-full flex-shrink flex-grow-0 p-4">
        <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
            <ul class="flex sm:flex-col overflow-hidden content-center justify-between">
                <li class="py-2 hover:bg-indigo-300 rounded">
                    <a class="truncate" href="/">
                        <img style="width:28px;height:28px;" alt="Back to texaswfc.com" title="Home"
                             src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/home.svg"
                             class="w-7 sm:mx-2 mx-4 inline" />
                        <span class="hidden sm:inline">Home</span>
                    </a>
                </li>
                <li class="py-2 hover:bg-indigo-300 rounded">
                    <a class="truncate" href="/about">
                        <img style="width:28px;height:28px;" alt="About TexasWFC.com" title="About this site"
                             src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/information-circle.svg"
                             class="w-7 sm:mx-2 mx-4 inline" />
                        <span class="hidden sm:inline">About</span>
                    </a>
                </li>
                <li class="py-2 hover:bg-indigo-300 rounded">
                    <a class="truncate" href="https://www.twc.texas.gov/" target="new">
                        <img style="width:28px;height:28px;" alt="Visit the Texas Workforce Commission site" title="Visit Texas Workforce Commission"
                             src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/external-link.svg"
                             class="w-7 sm:mx-2 mx-4 inline"  />
                        <span class="hidden sm:inline">TX Workforce Commission</span>
                    </a>
                </li>
            </ul>
        </div>
        <span class="space-y-4 space-x-4"> &nbsp; </span>
        <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
            <p class="space-y-2 px-1 py-1 prose"> This is the list of eligible training providers for the Texas Workforce
                Commission WIOA program. The data for this website is pulled from this
                <a class="underline" href="https://www.twc.texas.gov/files/partners/statewide-eligible-training-program-list-twc.xlsx"> Excel spreadsheet</a>
                that is available at the Texas Workforce Commission website.
                <br />
            </p>
            <p class="px-1 py-1 prose">

            </p>

        </div>
        <span class="space-y-4 space-x-4"> &nbsp; </span>
        <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">

                @livewire('lastmodified')
        </div>

        </div>

    <!-- end of left side navigation -->
