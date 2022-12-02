<x-app-layout>
    <x-jet-validation-errors class="mb-4"/>

    <h2>
        메이팅 등록
    </h2>

    <form id="matingcreate_form" method="POST" action="{{route('mating.store')}}">
        @csrf

        <livewire:mating-search
            :typeList="$typeList"
            :fatherReptileList="$fatherReptileList"
            :matherReptileList="$matherReptileList"
            :matingList="[]"
        />


        @include('parts.textarea')
        @include('parts.date-select')

        <div class="pr-4 m-auto max-w-[1280px]">
            @include('parts.submit', ["formId" => "matingcreate_form"])
        </div>

    </form>
</x-app-layout>
