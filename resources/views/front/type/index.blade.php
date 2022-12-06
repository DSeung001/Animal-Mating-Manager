<x-app-layout>
    <x-slot name="header">
        {{ __('Type List') }}
    </x-slot>

    <section class="antialiased bg-gray-100 text-gray-600 px-4">
        <div class="w-full max-w-[1280px] mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <div class="p-3">
                <form class="flex items-cente">

                    <div>
                        <label for="default-search"
                               class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="search" id="default-search"
                                   class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-sm"
                                   placeholder="Search Mockups, Logos..." required>
                        </div>
                    </div>

                    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>

                </form>
            </div>
        </div>
    </section>

    @include('parts.list', [
        'title' => '종들',
        'headers' => ['이름', '해칭기간', '작성일', '수정일'],
        'datas' => ['name', 'hatch_day', 'created_at', 'updated_at'],
        'decorator' => ['hatch_day' => '일']
    ])

    {!! $list->links() !!}
</x-app-layout>
