<x-app-layout>

    <h2>
       알 등록
    </h2>

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
