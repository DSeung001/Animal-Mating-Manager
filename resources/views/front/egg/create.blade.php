<x-app-layout>

    <x-slot name="header">
        {{ __('Egg Add') }}
    </x-slot>

    <form action="{{route('egg.store')}}" method="post">
        @csrf
        <livewire:mating-search-list
            :typeList="$typeList"
            :fatherReptileList="$fatherReptileList"
            :matherReptileList="$matherReptileList"
            :matingList="[]"
        />

    </form>
</x-app-layout>
