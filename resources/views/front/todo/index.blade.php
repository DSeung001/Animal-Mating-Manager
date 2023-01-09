<x-app-layout>
    <x-slot name="header">
        오늘 할일
    </x-slot>

    <div class="px-4 mt-8 mb-4">
        <div class="px-4 m-auto max-w-[1280px]">
            <div class="ml-3 text-right">
                <div class="text-2xl text-center font-bold">
                    <a href="{{$prevDay}}">
                        <image src="{{asset('images/todo_left_arrow.svg')}}" class="inline-block"/>
                    </a>
                    {{$now}}
                    <a href="{{$nextDay}}">
                        <image src="{{asset('images/todo_right_arrow.svg')}}" class="inline-block"/>
                    </a>
                </div>
                <a href="{{route("todo.create")}}">
                    <button type="button"
                            class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-3">
                        <image src="{{asset('images/post_write.svg')}}" class="w-5 h-5 inline-block"/>
                        일정 추가하기
                    </button>
                </a>
            </div>

            @forelse($list as $todo)
                @include('parts.todo-item', ['todo' => $todo])
            @empty
                <div class="mt-5">
                    <div class="p-2.5 text-sm hadow-lg rounded-sm border border-gray-200 bg-white shadow text-gray-800">
                        <div class="p-4">
                            <div class="pb-3">
                                <p class="text-lg font-semibold block pb-2">오늘 할 일은 없습니다!</p>
                            </div>
                        </div>
                    </div>
                </div>

            @endforelse
        </div>
    </div>

    @push('modals')
        @if(isset($todo))
            <form action="{{route('todo.destroy', $todo)}}" method="post">
                @csrf
                @method('delete')
                @include('parts.modal-delete')
            </form>
        @endif
    @endpush

    @push('scripts')
        <script>
            function todoFormActionChange(route) {
                document.getElementById("popup-delete-confirm").getElementsByTagName("form").action = route
                console.log(document.getElementById("popup-delete-confirm").getElementsByTagName("form").action);
            }
        </script>
    @endpush
</x-app-layout>
