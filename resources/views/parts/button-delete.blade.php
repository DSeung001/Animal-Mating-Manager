{{--
    $route : 삭제 기능 Route
    $content : 삭제 설명 문구
--}}

<div class="text-left mt-3 inline-block float-right">
    <button type="submit"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-modal-toggle="popup-delete-confirm">
        <image src="{{asset('images/post_delete_white.svg')}}" class="w-5 h-5 inline-block"/>
        삭제
    </button>
</div>

@push('modals')
    <form action="{{$route}}" method="post">
        @csrf
        @method('delete')
        @include('parts.modal-delete')
    </form>
@endpush
