<x-app-layout>
    <x-slot name="header">
        {{ __('Type Add') }}
    </x-slot>

    <x-jet-validation-errors class="mb-4" />

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form method="POST" action="{{route('type.store')}}">
                @csrf
                @include('parts.input', [
                            'title'=>'종류 명칭',
                            'name'=>'name',
                            'type'=>'text',
                            'placeholder'=> "ex:크레스티드게코"
                            ])
                @include('parts.input', [
                    'title'=>'부화 소요 기간(일 기준)',
                    'name'=>'hatch_day',
                    'type'=>'number',
                    'placeholder'=> '67'
                    ])
                @include('parts.textarea')
                @include('parts.submit')
            </form>
        </div>
    </div>

</x-app-layout>
