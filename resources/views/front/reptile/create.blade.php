<x-app-layout>

    <x-slot name="header">
        {{ __('Reptile Add') }}
    </x-slot>


    <x-jet-validation-errors class="mb-4"/>


    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form method="POST" action="{{route('reptile.store')}}" id="reptile-create-form">
                @csrf

                @include('parts.input', [
                      'title'=>'개체 이름',
                      'name'=>'name',
                      'type'=>'text',
                  ])

                <livewire:reptile-search-list
                    :typeList="$typeList"
                    :fatherReptileList="$fatherReptileList"
                    :matherReptileList="$matherReptileList"
                    :matingList="[]"
                />

                @include('parts.checkbox', [
                    'title'=>"성별 선택",
                    'list' => ['u' => '미구분', 'm' => '수컷', 'f' => '암컷'],
                    'type' => 'radio',
                    'name' => 'gender',
                    'changeListener' =>  'typeChange'
                ])

                @include('parts.input', [
                         'title'=>'개체 모프',
                         'name'=>'morph',
                         'type'=>'text',
                         'placeholder'=> "ex:트익할,릴리"
                         ])

                @include('parts.input', [
                         'title'=>'개체 생일',
                         'name'=>'birth',
                         'type'=>'date',
                         ])

                @include('parts.submit', ["formId" => "reptile-create-form"])
            </form>
        </div>
    </div>

    </x-guest-layout>
