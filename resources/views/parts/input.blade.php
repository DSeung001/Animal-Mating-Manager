{{--
    $title : 제목
    $type : input type
    $name : input name
    $isRequired : input is required | option
    $placeholder : input placeholder
    $value : input value | option
    $disabled : disabled | option
--}}

<div class="mb-6">
    <label for="{{$name}}-input" class="block text-sm font-medium text-gray-900 dark:text-white px-3 font-bold pb-3">{{$title}}</label>
    <input type="{{$type}}" id="{{$name}}-input" name="{{$name}}"
           class="shadow-sm {{isset($disabled) ? '' : 'bg-gray-50'}} border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
           {{isset($disabled) ? 'disabled' : ''}}
           value="{{isset($value) ? $value : old($name)}}"
           {{(isset($isRequired) && $isRequired == false) ? "" : "required"}}
           placeholder={{isset($placeholder) ? $placeholder : ""}}
    >
</div>
