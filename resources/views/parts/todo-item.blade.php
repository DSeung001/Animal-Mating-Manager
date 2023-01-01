<div class="mt-5">
    <div class="p-2.5 text-sm hadow-lg rounded-sm border border-gray-200 bg-white shadow text-gray-800">
        <div class="p-4">
            <div class="flex items-center pb-3">
                <input id="link-checkbox" type="checkbox" value=""
                       class="w-6 h-6 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="link-checkbox" class="ml-4 text-sm font-medium text-base">
                    밥 주기
                </label>
            </div>
            <a href="{{route('todo.create')}}" class="t-3">
                <image src="{{asset('images/post_edit_black.svg')}}" class="w-5 h-5 inline-block"/>
                일정 수정하기
            </a>
        </div>
    </div>
</div>
