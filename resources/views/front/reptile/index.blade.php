<x-app-layout>
    <x-slot name="header">
        {{ __('Reptile Add') }}
    </x-slot>

    <x-filter-table-menu action="{{route('reptile.index')}}">
        <div class="mr-4">
            @include('parts.table-search', [
                'placeholder' => '이름을 입력해주세요.',
                'name' => 'name',
                'isRequired' => false
            ])
        </div>
        <div class="mr-4">
            @include('parts.table-select', [
                'list' => $typeList,
                'name' => 'type',
                'default' => '전체'
           ])
        </div>
        <div class="mr-4">
            @include('parts.table-search', [
                'placeholder' => '모프를 입력해주세요.',
                'name' => 'morph',
                'isRequired' => false,
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
        'title' => '개체들',
        'headers' => ['이름', '종', '모프', '성별', '부', '모', '생일', '나이(개월)'],
        'datas' => ['name', 'type', 'morph', 'gender', 'father_name', 'mather_name', 'birth', 'age'],
        'decorator' => ['age' => '개월']
    ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif
</x-app-layout>
