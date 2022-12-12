<x-app-layout>
    <x-slot name="header">
        {{ __('Egg Page') }}
    </x-slot>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">

            @include('parts.input', [
                 'title'=>'종',
                 'name'=>'type',
                 'type'=>'text',
                 'placeholder'=> "종",
                 'value' => $typeName,
                 'disabled'=> true
            ])

            @include('parts.input', [
                 'title'=>'부모',
                 'name'=>'morph',
                 'type'=>'text',
                 'placeholder'=> "부모",
                 'value' => $fatherName." x ".$matherName,
                 'disabled'=> true
            ])

            @include('parts.input', [
               'title'=>'메이팅일',
               'name'=>'birth',
               'type'=>'date',
               'value' => $mating['mating_at'],
               'disabled'=> true
            ])

            @include('parts.input', [
               'title'=>'산란일',
               'name'=>'birth',
               'type'=>'date',
               'value' => $egg['spawn_at'],
               'disabled'=> true
            ])

            @include('parts.input', [
               'title'=>'해칭여부',
               'name'=>'is_hatching',
               'type'=>'text',
               'value' => $egg['is_hatching'],
               'disabled'=> true
            ])

            @include('parts.textarea',[
                'value' => $egg['comment'],
                'disabled' => true,
                'placeholder'=> ''
            ])

            @include('parts.button-modify', [
                'route' => route('egg.edit', $egg)
            ])
            @include('parts.button-list',[
                'route' => route('egg.index')
            ])
        </div>
    </div>
</x-app-layout>
