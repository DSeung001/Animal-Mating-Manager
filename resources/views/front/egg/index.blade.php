<x-app-layout>
    <x-slot name="header">
        {{ __('Egg List') }}
    </x-slot>

    <ul>
        @foreach($list as $item)
            <li>
                <a href="{{route("egg.edit",$item->id)}}">
                {{$item->name}} |
                {{$item->is_hatching}} |
                {{$item->comment}} |
                {{$item->created_at}}
                {{$item->updated_at}}
                </a>
            </li>
        @endforeach
    </ul>

    @include('parts.list', [
        'title' => '알',
        'headers' => ['산란일', '예상 부화일', '부화여부', '부', '모', '설명', '작성일', '수정일'],
        'datas' => ['name', 'type', 'morph', 'gender', 'father_name', 'mather_name', 'birth', 'age'],
    ])

</x-app-layout>
