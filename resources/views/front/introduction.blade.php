<x-guest-layout>

    <div class="h-auto mx-auto">
        <h2 class="text-4xl text-center font-bold pt-8">
            RMMW
        </h2>
        <h3 class="text-2xl text-center font-bold pt-5 pb-5">
            Reptile Meeting Management Web의 약자로 파충류 메이팅 관리 웹입니다.
            <br/>
            키우실 때 도움을 주고자 만들었습니다.
        </h3>


        <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                style="margin: 0 auto; display: block"
                onclick="location.href='{{route('login')}}'"
        >
            사용해보기
        </button>
        <hr class="mt-10"/>

        <h3 class="text-xl text-center font-bold pt-8 pb-4">
            1. 개체 관리를 위해 종류, 개체, 메이팅, 알 등의 정보를 등록하고 관리할 수 있습니다.
        </h3>
        <img class="h-auto mx-auto" src="{{asset('images/introduction/list_of_reptile.JPG')}}" alt="image description">
        <h3 class="text-xl text-center font-bold pt-8 pb-4">
            2. 오늘 할일을 등록해 오늘 무엇을 해야할 지 확인하실 수 있습니다.
        </h3>
        <img class="h-auto mx-auto" src="{{asset('images/introduction/schedule.JPG')}}" alt="image description">
        <h3 class="text-xl text-center font-bold pt-8 pb-4">
            3. 달별로 부화 예정인 알을 확인할 수 있습니다.
        </h3>
        <img class="h-auto mx-auto" src="{{asset('images/introduction/hatching_expected.JPG')}}" alt="image description">
        <h3 class="text-xl text-center font-bold pt-8 pb-4">
            4. 현재 키우는 개체수를 그래프로 쉽게 확인할 수 있습니다.
        </h3>
        <img class="h-auto mx-auto" src="{{asset('images/introduction/graph.JPG')}}" alt="image description">
    </div>


</x-guest-layout>
