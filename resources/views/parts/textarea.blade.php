{{--
    $value : texarea value
    $disabled : disabled | option
    $placeholder : placeholder
--}}

<label for="comment-textarea"
       class="block text-sm font-medium text-gray-900 dark:text-white px-3 font-bold pb-3">설명</label>
<div class="relative mb-6">
                <textarea name="comment" rows="4" maxlength="512" id="comment-textarea"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="{{isset($placeholder) ? '' : '여기에 설명을 적어주세요.'}}"
                          {{isset($disabled) ? 'disabled' : ''}}
                >{{isset($value) ? $value : old('comment')}}</textarea>
</div>
