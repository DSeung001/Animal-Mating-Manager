<x-app-layout>

    @include('parts.list', [
         'title' => '메이팅 이력',
         'headers' => ['부', '모', '설명', '메이팅일', '작성일', '수정일'],
         'datas' => ['father_name', 'mather_name', 'comment', 'mating_at', 'created_at', 'updated_at'],
     ])

</x-app-layout>
