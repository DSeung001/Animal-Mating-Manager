<x-app-layout>
    <x-slot name="header">
        {{ __('Type Modify') }}
    </x-slot>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form action="{{route('type.update', $type)}}" method="post">
                @csrf
                @method('patch')

                @include('parts.input', [
                    'title'=>'종류 명칭',
                    'name'=>'name',
                    'type'=>'text',
                    'placeholder'=> "ex:크레스티드게코",
                    'value' => $type['name'],
                ])
                @include('parts.input', [
                    'title'=>'부화 소요 기간(일 기준)',
                    'name'=>'hatch_day',
                    'type'=>'number',
                    'placeholder'=> '67',
                    'value' => $type['hatch_day'],
                ])
                @include('parts.textarea',[
                    'value' => $type['comment'],
                    'placeholder'=> ''
                ])

                @include('parts.button-submit')
                @include('parts.button-cancel', [
                    'route' => route('type.show', $type)
                ])
            </form>
        </div>
    </div>

</x-app-layout>
