{{--
    title : 제목
    $searchName : 검색 input name 값
    $list : 검색 리스트
    $name : 검색 리스트 name 값
--}}

<div>
    <h3>{{$title}}</h3>
    <div class="flex items-center justify-center">
        <div class="flex border-2 rounded">
            <input type="text" class="px-4 py-2 w-80"
                   placeholder="Search..." name="{{$searchName}}" value="{{old($searchName)}}">
        </div>
    </div>

    <ul class="pl-5 space-y-3 text-gray-600 list-decimal marker:text-purple-600">
        @foreach($list as $key => $value)
            <li>{{$value}}
                <input
                    name="{{$name}}"
                    class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer"
                    type="radio" id="checkbox_{{$name}}" value="{{$key}}"
                    @if(
                        old($name) == $key
                    )
                        checked
                    @endif
                >
            </li>
        @endforeach

        <li>알 수 없음
            <input
                name="{{$name}}"
                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer"
                type="radio" id="checkbox_{{$name}}" value="">
        </li>
    </ul>
</div>
