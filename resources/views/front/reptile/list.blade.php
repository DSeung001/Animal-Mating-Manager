<x-app-layout>
    <x-slot name="header">
        개체 목록
    </x-slot>

    <x-filter-table-menu action="{{route('reptile.index')}}">

        @include('parts.table-search', [
            'placeholder' => '이름 검색.',
            'name' => 'name',
            'isRequired' => false,
            'label' => '이름'
        ])

        @include('parts.table-select', [
            'list' => $typeList,
            'name' => 'type',
            'default' => '전체',
            'label' => '종류'
       ])

        <div class="mobile-none">
            @include('parts.table-search', [
            'placeholder' => '모프로 검색.',
            'name' => 'morph',
            'isRequired' => false,
            'label' => '모프'
        ])
        </div>

        <div class="mobile-none">
            @include('parts.table-select', ['list' => [
                '10' => '10',
                '20' => '30',
                '40' => '40',
                'all' => 'ALL'],
                'name' => 'paginate',
                'label' => '페이징'
            ])
        </div>
    </x-filter-table-menu>

    @include('parts.list', [
        'showRoute' => 'reptile.show',
        'title' => "개체들($listLength)",
        'headers' => ['이름', '종', '모프', '성별', '상태', '부', '모', '생일', '나이(개월)'],
        'datas' => ['name', 'type', 'morph', 'gender', 'status', 'father_name', 'mather_name', 'birth', 'age']
    ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif
</x-app-layout>
