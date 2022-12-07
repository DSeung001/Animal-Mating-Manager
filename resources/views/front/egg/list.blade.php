<x-app-layout>
    <x-slot name="header">
        {{ __('Egg List') }}
    </x-slot>

    <x-filter-table-menu action="{{route('egg.index')}}">
        @include('parts.table-date', [
            'label' => '산란일',
            'name' => 'spawn_at',
        ])

        @include('parts.table-select', [
            'list' => $hatchingList,
            'name' => 'hatching',
            'default' => '전체',
            'label' => '부화여부'
       ])

        @include('parts.table-select', [
            'list' => $typeList,
            'name' => 'type',
            'default' => '전체',
            'label' => '종류'
       ])

        @include('parts.table-select', ['list' => [
            '10' => '10',
            '20' => '30',
            '40' => '40',
            'all' => 'ALL'],
            'name' => 'paginate',
            'label' => '페이징'
        ])
    </x-filter-table-menu>

    @include('parts.list', [
        'showRoute' => 'egg.show',
        'list' => $list,
        'title' => '알',
        'headers' => ['산란일', '예상 부화일', '부화여부', '종', '부', '모'],
        'datas' => ['spawn_at', 'estimated_date', 'is_hatching', 'type_name', 'father_name', 'mather_name'],
    ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif
</x-app-layout>
