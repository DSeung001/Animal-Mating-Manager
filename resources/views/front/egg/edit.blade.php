<x-app-layout>
    <x-slot name="header">
        {{ __('Egg Modify') }}
    </x-slot>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form id="mating-create-form" method="POST" action="{{route('egg.update', $egg)}}">
                @method('patch')
                @csrf

                <livewire:mating-search-list
                    :typeList="$typeList"
                    :maleReptilePluck="$maleReptilePluck"
                    :femaleReptilePluck="$femaleReptilePluck"
                    :matingList="$matingList"
                    :typeSelected="$matingList[0]['type_id']"
                    :fatherSelected="$matingList[0]['father_id']"
                    :matherSelected="$matingList[0]['mather_id']"
                    :matingIdSelected="$matingList[0]['id']"
                />

                @include('parts.input', [
                         'title'=>'산란일',
                         'name'=>'spawn_at',
                         'type'=>'date',
                         'value'=>$egg['spawn_at']
                    ])

                @include('parts.select', [
                    'list' => [
                        'w' => '대기',
                        'y' => '해칭완료',
                        'n' => '해칭실패',
                    ],
                    'name' => 'is_hatching',
                    'label' => '해칭여부',
                    'selected' => $egg['is_hatching']
                ])

                @include('parts.textarea', [
                    'value' => $egg['comment']
                ])

                @include('parts.button-submit', [
                    "formId" => "reptile-create-form"
                ])

                @include('parts.button-cancel', [
                    'route' => route('egg.show', $egg)
                ])
            </form>
        </div>
    </div>
</x-app-layout>
