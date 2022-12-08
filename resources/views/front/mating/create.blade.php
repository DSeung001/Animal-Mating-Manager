<x-app-layout>
    <x-jet-validation-errors class="mb-4"/>

    <x-slot name="header">
        {{ __('Mating Add') }}
    </x-slot>


    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form id="mating-create-form" method="POST" action="{{route('mating.store')}}">
                @csrf

                <livewire:reptile-search-list
                    :typeList="$typeList"
                    :fatherReptileList="$fatherReptileList"
                    :matherReptileList="$matherReptileList"
                    :matingList="[]"
                />

                @include('parts.textarea')

                @include('parts.input', [
                         'title'=>'메이팅 일시',
                         'name'=>'mating_at',
                         'type'=>'date',
                         ])

                @include('parts.button-submit', ["formId" => "reptile-create-form"])
            </form>
        </div>
    </div>
</x-app-layout>
