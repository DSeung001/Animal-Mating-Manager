<x-app-layout>
    <ul>
        @foreach($list as $item)
            <li>
                <a href="{{route("type.edit",$item->id)}}">
                {{$item->name}} |
                {{$item->hatch_day}} |
                {{$item->comment}} |
                {{$item->created_at}}
                {{$item->updated_at}}
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
