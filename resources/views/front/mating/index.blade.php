<x-app-layout>
    <x-slot name="header">
        {{ __('Mating List') }}
    </x-slot>

    <x-filter-table-menu action="{{route('mating.index')}}">
        @include('parts.table-search', [
            'placeholder' => '부 개체를 입력해주세요.',
            'name' => 'father_name',
            'isRequired' => false,
            'label' => '부 개체 이름'
        ])

        @include('parts.table-search', [
            'placeholder' => '모 개체를 입력해주세요.',
            'name' => 'mather_name',
            'isRequired' => false,
            'label' => '모 개체 이름'
        ])

        @include('parts.table-date', [
            'label' => '메이팅일',
            'name' => 'mating_at',
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
         'title' => '메이팅 이력',
         'headers' => ['부', '모', '설명', '메이팅일', '작성일', '수정일'],
         'datas' => ['father_name', 'mather_name', 'comment', 'mating_at', 'created_at', 'updated_at'],
     ])

    @if(($_GET['paginate'] ?? '') != 'all' )
        {!! $list->links() !!}
    @endif
</x-app-layout>
