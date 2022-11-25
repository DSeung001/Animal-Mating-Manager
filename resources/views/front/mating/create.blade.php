<x-app-layout>
    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{route('mating.store')}}">
        @csrf

        <div>
            <x-jet-label for="type" value="부 개체"/>
            @include("parts.select", ["name"=>"father_id", "list"=>$maleReptileList, "placeholder"=>"없음"])
        </div>

        <div>
            <x-jet-label for="type" value="모 개체"/>
            @include("parts.select", ["name"=>"mather_id", "list"=>$femaleReptileList, "placeholder"=>"없음"])
        </div>

        <div>
            <x-jet-label for="comment" value="메모"/>
            <x-jet-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')"
                         autofocus/>
        </div>

        <div>
            <x-jet-label for="mating_at" value="메이팅 일" />
            <x-jet-input id="mating_at" class="block mt-1 w-full" type="date" name="mating_at" :value="old('mating_at') ?? now()->isoFormat('YYYY-MM-DD')" required autofocus/>
        </div>

        <x-jet-button class="ml-4">
            저장
        </x-jet-button>
    </form>
</x-app-layout>
