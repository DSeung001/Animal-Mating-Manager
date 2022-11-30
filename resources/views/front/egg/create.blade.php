<x-app-layout>
    <x-jet-validation-errors class="mb-4"/>

    {{-- 부모 개체 선택 시 알맞은 메이팅으로 변경--}}

    {{--  해당 form에서 고른 값도 session으로 --}}
    <form method="GET" action="{{route('egg.create')}}">
        <div class="text-center">
            @include("parts.select-search", ["list"=>$typeList, "name"=>"tid", "title"=>"종", "searchName"=>"ts"])

            @include("parts.select-search", ["list"=>$matherReptileList, "name"=>"mid", "title"=>"모 개체", "searchName"=>"ms"])

            @include("parts.select-search", ["list"=>$fatherReptileList, "name"=>"fid", "title"=>"부 개체", "searchName"=>"fs"])
        </div>
        <button type="submit" class="flex items-center justify-center px-4 border-l">
            <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24">
                <path
                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
            </svg>
        </button>
    </form>

    <br/>
    <hr/>
    <br/>

    <form action="{{route('egg.store')}}" method="POST">

        <textarea name="comment" rows="4"></textarea> <br/>

        @csrf

        {{
            isset($fatherReptile) ? $fatherReptile->name : "미선택"
        }}
        X
        {{
            isset($matherReptile) ? $matherReptile->name : "미선택"
        }}


        <ul class="pl-5 space-y-3 text-gray-600 list-decimal marker:text-purple-600">
            @foreach($matingList as $item)
                <li>{{$item->mating_at}}
                    <input
                        name="mating_id"
                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer"
                        type="radio" id="checkbox_mating_id" value="{{$item->id}}"
                    >
                </li>
            @endforeach

            <li>알 수 없음
                <input
                    name="mating_id}"
                    class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer"
                    type="radio" id="checkbox_mating_id" value="">
            </li>
        </ul>

        산란일 :
        <input type="date" name="spawn_at"/>

        <x-jet-button class="ml-4">
            저장
        </x-jet-button>
    </form>
</x-app-layout>
