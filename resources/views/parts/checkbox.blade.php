{{--
    $title : 제목
    $list : 체크박스 리스트
    $name : 이름
    $type : input type
    $changeListener : checkbox ChangeListener | option
    $selectedKey : 선택된 키 값 |  option
--}}

<div class="mb-6 pt-3">
    @if(isset($title))
        <p class="font-bold pb-3 text-sm px-3">
            {{$title}}
        </p>
    @endif

    @foreach($list as $key => $text)
        <div class="items-center mr-4 inline-block">
            <input id="inline-checkbox-{{$key}}" type="{{$type ?? "checkbox"}}" value="{{$key}}" name="{{$name}}"
                   class="w-4 h-4 text-blue-700 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                @if( isset($selectedKey) )
                   {{ $key == $selectedKey ? "checked" : "" }}
                @else
                   {{ $key == old($name) ? "checked" : "" }}
                @endif

                @if(isset($changeListener))
                   wire:change="{{$changeListener}}($event.target.value)"
                @endif
            >
            <label for="inline-checkbox-{{$key}}"
                   class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$text}}</label>
        </div>
    @endforeach
</div>
