<x-app-layout>
    <x-slot name="header">
        {{ __('Type Page') }}
    </x-slot>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            @include('parts.input', [
                'title'=>'종류 명칭',
                'name'=>'name',
                'type'=>'text',
                'placeholder'=> "ex:크레스티드게코",
                'value' => $type['name'],
                'disabled' => true
            ])
            @include('parts.input', [
                'title'=>'부화 소요 기간(일 기준)',
                'name'=>'hatch_day',
                'type'=>'number',
                'placeholder'=> '67',
                'value' => $type['hatch_day'],
                'disabled' => true
            ])
            @include('parts.textarea',[
                'value' => $type['comment'],
                'disabled' => true,
                'placeholder'=> ''
            ])
            @include('parts.button-modify', [
                'route' => route('type.edit', $type)
            ])
            @include('parts.button-list',[
                'route' => route('type.index')
            ])
        </div>
    </div>

</x-app-layout>
