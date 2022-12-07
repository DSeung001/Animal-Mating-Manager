<section class="antialiased bg-gray-100 text-gray-600 px-4 mt-6">
    <div class="w-full max-w-[1280px] mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <div class="p-3">
            <form class="flex items-cente" action="{{$action}}" method="GET">

                {{ $slot }}


                <div class="pt-6">
                    <button type="submit"
                            class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
