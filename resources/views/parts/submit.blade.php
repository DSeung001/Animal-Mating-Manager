{{--
    $formId : submit 할 form id
--}}


<div class="text-left mt-5">
    <button type="{{isset($fomrId) ? "button" : "submit"}}" id="form-submit" onclick="identity()"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Submit
    </button>
</div>

@if(isset($formId))
    @push('scripts')
        <script>
            function identity() {
                document.getElementById("{{$formId}}").submit();
            }
        </script>
    @endpush
@endif
