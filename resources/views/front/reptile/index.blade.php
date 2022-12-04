<x-app-layout>

    <x-slot name="header">
        {{ __('Reptile Add') }}
    </x-slot>

    @include('parts.list', [
        'title' => '개체들',
        'headers' => ['이름', '종', '모프', '성별', '부', '모', '생일', '나이'],
        'datas' => ['name', 'type', 'morph', 'gender', 'father_name', 'mather_name', 'birth', 'age'],
        'decorator' => ['age' => '개월']
    ])

</x-app-layout>
