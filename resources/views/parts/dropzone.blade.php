<div class="mb-6">
    <label for="reptile_photo" class="block text-sm font-medium text-gray-900 dark:text-white px-3 font-bold pb-3">
        개체 사진 업로드
    </label>
    <div class="dropzone-container max-w-2xl">
        <img src="{{asset('images/x_button.svg')}}" class="float-right {{isset($value) ? '' : 'hidden'}} x-button cursor-pointer"/>
        <div id="drop-zone"
             class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light cursor-pointer">
            <p class="placeholder {{isset($value) ? 'hidden' : ''}}" >
                사진 드래그 앤 드롭 해주세요,
                또는 클릭해서 업로드해주세요.
            </p>
            <img class="target-image {{isset($value) ? '' : 'hidden'}}" src="{{isset($value) ? asset($value) : ''}}" alt="">
            <input name="reptile_photo" type="file" hidden accept="image/*">
            <input class="modified" name="modified" type="hidden" value="false">
        </div>
    </div>
</div>


@push('styles')
    <link href="{{asset('style/parts/dropzone.css')}}" rel="stylesheet"/>
@endpush
@push('scripts')
    <script src='{{asset('js/parts/dropzone.js')}}'></script>
@endpush
