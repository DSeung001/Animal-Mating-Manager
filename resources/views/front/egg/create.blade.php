<x-app-layout>
    <x-slot name="header">
        {{ __('Egg Add') }}
    </x-slot>

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">
            <form action="{{route('egg.store')}}" method="post" id="egg-create-form">
                @csrf
                <livewire:mating-search-list
                    :typeList="$typeList"
                    :fatherReptileList="$fatherReptileList"
                    :matherReptileList="$matherReptileList"
                    :matingList="[]"
                />

                @include('parts.input', [
                         'title'=>'산란일',
                         'name'=>'spawn_at',
                         'type'=>'date',
                    ])

                @include('parts.textarea')

                @include('parts.submit', ["formId" => "egg-create-form"])
            </form>
        </div>
    </div>

</x-app-layout>
