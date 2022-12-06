{{--
    $title : 제목
    $list : 데이터 리스트
    $identity : 구분자
    $default : 기본 값
    $searchListener : component search listener
    $selectListener : component search listener
--}}

<div class="mb-2">
    @if(isset($title))
        <p class="pb-4 font-bold text-sm px-3">
            {{$title}}
        </p>
    @endif

    <div class="flex items-center">
        <label for="{{$identity}}-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="{{$identity}}-search"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Search"
                   wire:change="{{$searchListener}}($event.target.value)"
            >
        </div>
        <button type="button"
                class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </div>
    <ul class="overflow-y-auto pb-3 max-h-48 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownSearchButton">
        @if(isset($default))
            <li>
                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input name="{{$identity}}" id="select-search-{{$identity}}-default" type="radio" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                           @if(isset($selectListener))
                           wire:click="{{$selectListener}}"
                        @endif
                    >
                    <label for="select-search-{{$identity}}-default"
                           class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$default}}</label>
                </div>
            </li>
        @endif
        @foreach($list as $key => $value)
            <li>
                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input name="{{$identity}}" id="select-search-{{$identity}}-{{$key}}" type="radio" value="{{$key}}"
                           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                           @if(isset($selectListener))
                           wire:click="{{$selectListener}}"
                        @endif
                    >
                    <label for="select-search-{{$identity}}-{{$key}}"
                           class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                        {{$value}}
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
