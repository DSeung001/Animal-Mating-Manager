<x-app-layout>
    <x-slot name="header">
        {{ __('Egg List') }}
    </x-slot>

    @include('parts.list', [
        'list' => $list,
        'title' => '알',
        'headers' => ['산란일', '예상 부화일', '부화여부', '종', '부', '모'],
        'datas' => ['spawn_at', 'estimated_date', 'is_hatching', 'type_name', 'father_name', 'mather_name'],
    ])

</x-app-layout>
