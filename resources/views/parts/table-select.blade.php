{{--
    $name : select name
    $list : select 출력 데이터
--}}

<select
    name="{{$name}}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pr-6">
    @if(isset($default))
        <option value="" {{ ($_GET[$name] ?? '') == "" ? "selected" : ""}}>{{$default}}</option>
    @endif
    @foreach($list as $key => $value)
        <option value="{{$key}}" {{ ($_GET[$name] ?? '') == $key ? "selected" : ""}}>{{$value}}</option>
    @endforeach
</select>
