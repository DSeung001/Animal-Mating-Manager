<x-app-layout>
    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{route('reptile.store')}}">
        @csrf

        <div>
            <x-jet-label for="name" value="개체 이름" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus/>
        </div>

        <div>
            <x-jet-label for="type" value="종류"/>
            @include("parts.select", ["name"=>"type_id", "list"=>$typeList, "placeholder"=>"종류를 추가해주세요."])
        </div>

        <div>
            <x-jet-label for="type" value="부 개체"/>
            @include("parts.select", ["name"=>"father_id", "list"=>$maleReptileList, "default"=>"알 수 없음"])
        </div>

        <div>
            <x-jet-label for="type" value="모 개체"/>
            @include("parts.select", ["name"=>"mather_id", "list"=>$femaleReptileList, "default"=>"알 수 없음"])
        </div>

        <div>
            <x-jet-label for="type" value="성별"/>
            @include("parts.select", ["name"=>"gender", "list"=>[
                'm' => '수컷',
                'f' => '암컷',
                'u' => '미구분'
            ]])
        </div>

        <div>
            <x-jet-label for="morph" value="개체 모프" />
            <x-jet-input id="morph" class="block mt-1 w-full" type="text" name="morph" :value="old('morph')" required autofocus/>
        </div>

        <div>
            <x-jet-label for="birth" value="개체 생일" />
            <x-jet-input id="birth" class="block mt-1 w-full" type="date" name="birth" :value="old('birth') ?? now()->isoFormat('YYYY-MM-DD')" required autofocus/>
        </div>

        <x-jet-button class="ml-4">
            저장
        </x-jet-button>
    </form>
</x-guest-layout>
