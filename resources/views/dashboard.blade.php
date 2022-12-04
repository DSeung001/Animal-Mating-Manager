<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <ul>
                    <li>
                        - <a href="{{route('type.create')}}">종 등록</a>
                        <br/>
                        - <a href="{{route('type.index')}}">종 리스트</a>
                    </li>
                    <li>
                        - <a href="{{route('reptile.create')}}">개체 등록</a>
                        <br/>
                        - <a href="{{route('reptile.index')}}">개체 리스트</a>
                    </li>
                    <li>
                        - <a href="{{route('mating.create')}}">메이팅 등록</a>
                        <br/>
                        - <a href="{{route('mating.index')}}">메이팅 리스트</a>
                    </li>
                    <li>
                        - <a href="{{route('egg.create')}}">알 등록</a>
                        <br/>
                        - <a href="{{route('egg.index')}}">알 리스트</a>
                    </li>

                    <hr/>
                    <li>
                        - <a href="{{url('login')}}">로그인</a>
                        <br/>
                        - <a href="{{url('register')}}">회원가입</a>
                    </li>
                </ul>
            </div>
        </div>


    @push('scripts')
        <script>
            @if (session('status'))
            alert("{{ session('status') }}");
            @endif
        </script>
    @endpush

</x-app-layout>
