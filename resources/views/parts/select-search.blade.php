<div>
    <h3>{{$title}}</h3>
    <div class="flex items-center justify-center">
        <div class="flex border-2 rounded">
            <input type="text" class="px-4 py-2 w-80" placeholder="Search..." name="{{$searchName}}" value="{{old($searchName)}}">
            <button type="submit" class="flex items-center justify-center px-4 border-l">
                <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24">
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
                </svg>
            </button>
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
