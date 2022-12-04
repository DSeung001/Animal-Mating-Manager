<x-app-layout>
    <x-slot name="header">
        {{ __('Type Add') }}
    </x-slot>


    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{route('type.store')}}">
        @csrf
        <div>
            <x-jet-label for="name" value="종 명칭"/>
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus/>
        </div>
        <div>
            <x-jet-label for="hatch_day" value="부화 소요 기간(일 기준)"/>
            <x-jet-input id="hatch_day" class="block mt-1 w-full" type="number" name="hatch_day"
                         :value="old('hatch_day')" required autofocus/>
        </div>
        <div>
            <x-jet-label for="comment" value="메모"/>
            <x-jet-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')"
                         autofocus/>
        </div>

        <x-jet-button>
            저장
        </x-jet-button>
    </form>
</x-app-layout>
