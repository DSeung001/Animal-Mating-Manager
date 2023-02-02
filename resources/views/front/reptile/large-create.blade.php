<x-app-layout>

    <x-slot name="header">
        개체 추가
    </x-slot>

    <x-jet-validation-errors class="mb-4"/>

    @php
        if(isset($_GET['count'])){
            $count = $_GET['count'] === "" ? 1 : $_GET['count'];
        } else {
            $count = 1;
        }
    @endphp

    <div class="px-4 mt-8 mb-4">
        <div class="p-4 bg-white shadow m-auto max-w-[1280px]">

            <p class="text-xl text-center font-bold pt-8 pb-4">
                간단하게 한 번에 여러 마리를 등록할 수 있습니다.(최대 100마리)
            </p>
            <hr class="mb-5"/>

            <form action="{{route('reptile.large.create')}}" method="GET">
                <div class="text-left mt-3 mb-5">
                    <span class="text-sm font-medium text-gray-900 dark:text-white font-bold pb-3">마리 수</span> :
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-15 inline-block" name="count" type="number" max="100"
                           value="{{$count}}"
                    />
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-4">
                        <image src="{{asset('images/list.svg')}}" class="w-5 h-5 inline-block"/>
                        등록한 마리 수 변경
                    </button>
                </div>
            </form>

            <hr class="mb-5"/>

            <form method="POST" action="{{route('reptile.large-store')}}" id="reptile-large-create-form">
                @csrf

                <div>
                    @include('parts.checkbox', [
                        'title'=>"전체 종 선택",
                        'list' => $typeList,
                        'type' => 'radio',
                        'name' => 'type_id',
                    ])
                    <hr class="mt-7 mb-7"/>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                이름
                            </th>
                            <th scope="col" class="px-6 py-3">
                                모프
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($repeat = 0; $repeat < $count; $repeat++)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <input
                                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        name="name[]"
                                        required>
                                </td>
                                <td class="py-4">
                                    <div>
                                        <input
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            name="morph[]"
                                            required>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>


                @include('parts.button-submit')
            </form>
        </div>
    </div>
</x-app-layout>
