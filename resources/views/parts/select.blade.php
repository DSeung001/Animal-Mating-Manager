{{--
    $name : select name
    $label : label
    $list : select 출력 데이터
    $selected : 선택값
--}}

<div class="mb-6">
    <label for="{{$name}}-input" class="block text-sm font-medium text-gray-900 dark:text-white px-3 font-bold pb-3">{{$label}}</label>
    <select
        id="table-select-{{$name}}"
        name="{{$name}}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pr-6">
        @foreach($list as $key => $value)
            <option value="{{$key}}" {{ ($selected ?? '') == $key ? "selected" : ""}}>{{$value}}</option>
        @endforeach
    </select>
</div>
