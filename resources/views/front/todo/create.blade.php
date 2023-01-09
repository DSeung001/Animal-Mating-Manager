<x-app-layout>

    <x-slot name="header">
        할일 추가
    </x-slot>

    <x-jet-validation-errors class="mb-4"/>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form method="POST" action="{{route('todo.store')}}">
                @csrf
                @include('parts.input', [
                            'title'=>'해야하는 것',
                            'name'=>'name',
                            'type'=>'text',
                            ])
                @include('parts.input', [
                            'title'=>'주기(일 기준)',
                            'name'=>'cycle',
                            'type'=>'number',
                            ])
                @include('parts.input', [
                               'title'=>'시작일',
                               'name'=>'started_at',
                               'type'=>'date',
                            ])
                @include('parts.textarea')
                @include('parts.button-submit')
            </form>
        </div>
    </div>
</x-app-layout>
