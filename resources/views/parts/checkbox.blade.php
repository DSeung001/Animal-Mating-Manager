{{--
    $title : 제목
    $list : 체크박스 리스트
    $name : 이름
    $type : input type
--}}

<div class="max-w-[1280px] bg-white shadow m-auto">
    @if(isset($title))
        <h3 class="text-center p-2 font-bold">
            {{$title}}
        </h3>
    @endif

    <div class="flex justify-center pb-4">
        @foreach($list as $key => $value)
            <div class="flex items-center mr-4">
                <input id="inline-checkbox" type="{{$type ?? "checkbox"}}" value="{{$key}}" name="{{$name}}"
                       class="w-4 h-4 text-blue-700 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                       {{ $key == old($name) ? "checked" : "" }}
                >
                <label for="inline-checkbox"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$value}}</label>
            </div>
        @endforeach
    </div>
</div>
