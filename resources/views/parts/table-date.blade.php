{{--
    $name : name
--}}

<div class="mr-4">
    <label for="table-date-{{$name}}" class="text-sm">
        {{$label}}
    </label>
    <div class="relative">
        <input
            id="table-date-{{$name}}"
            type="date"
            value="{{$_GET['mating_at'] ?? ''}}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date" name="{{$name}}">
    </div>
</div>
