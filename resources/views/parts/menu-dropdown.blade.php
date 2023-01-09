{{--
    $title : 제목
    $identtiy : 메뉴 고유명칭
    $menus : 서브 메뉴 배열 (key => 메뉴명(영문), value => route)
--}}


<button id="{{$identity}}-menu-dropdown-button" data-dropdown-toggle="{{$identity}}-menu-dropdown"
        class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700 tablet-header-font">
    {{$title}}
    <svg aria-hidden="true" class="ml-1 w-5 h-5 md:w-4 md:h-4" fill="currentColor"
         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
    </svg>
</button>
<div id="{{$identity}}-menu-dropdown" class="grid hidden absolute z-10 w-auto text-sm bg-white rounded-lg border border-gray-100 shadow-md dark:border-gray-700 dark:bg-gray-700">
    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
        <ul class="space-y-4" aria-labelledby="{{$identity}}-menu-dropdown-button">
            @foreach($menu as $key => $value)
                <li>
                    <a href="{{$value}}" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 text-center px-6">
                        {{$key}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
