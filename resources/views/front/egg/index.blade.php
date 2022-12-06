<x-app-layout>
    <x-slot name="header">
        {{ __('Egg List') }}
    </x-slot>

    <x-filter-table-menu action="{{route('mating.index')}}">
        {{--        <div class="mr-4">--}}
        {{--            @include('parts.table-search', [--}}
        {{--                'placeholder' => '이름을 입력해주세요.',--}}
        {{--                'name' => 'name',--}}
        {{--                'isRequired' => false--}}
        {{--            ])--}}
        {{--        </div>--}}
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
        'list' => $list,
        'title' => '알',
        'headers' => ['산란일', '예상 부화일', '부화여부', '종', '부', '모'],
        'datas' => ['spawn_at', 'estimated_date', 'is_hatching', 'type_name', 'father_name', 'mather_name'],
    ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif
</x-app-layout>
