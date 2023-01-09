<x-app-layout>
    <x-slot name="header">
        메이팅 추가
    </x-slot>

    <x-jet-validation-errors class="mb-4"/>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form method="POST" action="{{route('mating.store')}}">
                @csrf

                <livewire:reptile-search-list
                    :typeList="$typeList"
                    :maleReptilePluck="$maleReptilePluck"
                    :femaleReptilePluck="$femaleReptilePluck"
                />

                @include('parts.input', [
                         'title'=>'메이팅 일시',
                         'name'=>'mating_at',
                         'type'=>'date',
                         ])

                @include('parts.textarea')

                @include('parts.button-submit', ["formId" => "reptile-create-form"])
            </form>
        </div>
    </div>
</x-app-layout>
