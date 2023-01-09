<x-app-layout>
    <x-slot name="header">
        종류 목록
    </x-slot>

    <x-filter-table-menu action="{{route('type.index')}}">
        @include('parts.table-search', [
            'placeholder' => '이름 검색',
            'name' => 'name',
            'isRequired' => false,
            'label' => '이름'
        ])

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
        'showRoute' => 'type.show',
        'title' => '종들',
        'headers' => ['이름', '해칭기간', '작성일', '수정일'],
        'datas' => ['name', 'hatch_day', 'created_at', 'updated_at'],
        'decorator' => ['hatch_day' => '일']
    ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif

</x-app-layout>
