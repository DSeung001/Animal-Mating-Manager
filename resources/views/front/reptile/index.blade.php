<x-app-layout>
    <ul>
        @foreach($list as $item)
            <li>
                <a href="{{route("reptile.edit",$item->id)}}">
                    {{$item->user_id}} |
                    {{$item->type_id}} |
                    {{$item->father_id}} |
                    {{$item->mather_id}}
                    {{$item->name}} |
                    {{$item->gender}} |
                    {{$item->morph}} |
                    {{$item->birth}} |
                    {{$item->updated_at}} |
                    {{$item->created_at}} |
                    {{$item->type->name}} |
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
