<x-app-layout>

    @include('parts.list', [
        'title' => '종들',
        'headers' => ['이름', '설명', '해칭기간', '작성일', '수정일'],
        'datas' => ['name', 'comment', 'hatch_day', 'created_at', 'updated_at'],
        'decorator' => ['hatch_day' => '일']
    ])

</x-app-layout>
