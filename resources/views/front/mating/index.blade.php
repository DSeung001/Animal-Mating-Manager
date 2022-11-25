<x-app-layout>
    <ul>
        @foreach($list as $item)
            <li>
                <a href="{{route("mating.edit",$item->id)}}">
                    {{$item->father_id}} |
                    {{$item->mather_id}} |
                    {{$item->comment}} |
                    {{$item->mating_at}} |
                    {{$item->create_at}} |
                    {{$item->updated_at}}
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
