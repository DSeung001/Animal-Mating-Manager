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


        <div class="px-4">
            <div class="p-4 bg-white shadow m-auto">
                <div class="relative">
                    <input datepicker type="date"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Select date">
                </div>
            </div>
        </div>

        @include('parts.submit', ["formId" => "matingcreate_form"])
    </form>
</x-app-layout>
