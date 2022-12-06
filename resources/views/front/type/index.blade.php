<x-app-layout>
    <x-slot name="header">
        {{ __('Type List') }}
    </x-slot>

    <x-filter-table-menu action="{{route('type.index')}}">
        <div class="mr-4">
            @include('parts.table-search', [
                'placeholder' => '이름을 입력해주세요.',
                'name' => 'name',
                'isRequired' => false
            ])
        </div>
        <div class="mr-4">
            @include('parts.table-select', ['list' => [
                '10' => '10',
                '20' => '30',
                '40' => '40',
                'all' => 'ALL',
            ], 'name' => 'paginate'])
        </div>
    </x-filter-table-menu>


    @include('parts.list', [
        'title' => '종들',
        'headers' => ['이름', '해칭기간', '작성일', '수정일'],
        'datas' => ['name', 'hatch_day', 'created_at', 'updated_at'],
        'decorator' => ['hatch_day' => '일']
    ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif

</x-app-layout>
