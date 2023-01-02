<x-app-layout>

    <x-slot name="header">
        {{ __('Todo Add') }}
    </x-slot>

    <x-jet-validation-errors class="mb-4"/>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form method="POST" action="{{route('todo.update', $todo)}}">
                @csrf
                @method('patch')

                @include('parts.input', [
                            'title'=>'해야하는 것',
                            'name'=>'name',
                            'type'=>'text',
                            'value' => $todo['name'],
                            ])
                @include('parts.input', [
                            'title'=>'주기(일 기준)',
                            'name'=>'cycle',
                            'type'=>'number',
                            'value' => $todo['cycle'],
                            ])
                @include('parts.input', [
                               'title'=>'시작일',
                               'name'=>'started_at',
                               'type'=>'date',
                               'value' => $todo['started_at'],
                            ])
                @include('parts.textarea',[
                                'value' => $todo['comment'],
                                'placeholder'=> ''
                            ])
                @include('parts.button-submit')
                @include('parts.button-cancel', [
                    'route' => route('todo.index')
                ])
            </form>

        </div>
    </div>
</x-app-layout>
