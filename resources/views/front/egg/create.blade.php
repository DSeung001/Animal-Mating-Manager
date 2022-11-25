<x-app-layout>
    <x-jet-validation-errors class="mb-4"/>

    {{-- 부모 개체 선택 시 알맞은 메이팅으로 변경--}}

    {{--  해당 form에서 고른 값도 session으로 --}}
    <form method="GET" action="{{route('egg.create')}}">
        <div class="text-center">
            @include("parts.select-search", ["list"=>$typeList, "name"=>"tid", "title"=>"종류", "searchName"=>"ts"])

            @include("parts.select-search", ["list"=>$matherReptileList, "name"=>"mid", "title"=>"모 개체", "searchName"=>"ms"])

            @include("parts.select-search", ["list"=>$fatherReptileList, "name"=>"fid", "title"=>"부 개체", "searchName"=>"fs"])
        </div>
    </form>

    <br/>
    <hr/>
    <br/>

    <form action="{{route('egg.store')}}">
        @csrf

        {{$fatherReptile->name." x ".$matherReptile->name}}


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

        <x-jet-button class="ml-4">
            저장
        </x-jet-button>
    </form>
</x-app-layout>
