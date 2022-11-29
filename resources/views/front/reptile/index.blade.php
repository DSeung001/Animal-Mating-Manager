<x-app-layout>

    <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
        <div class="flex flex-col justify-center h-full">
            <!-- Table -->
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800 ml-3">
                        개체들
                    </h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">이름</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">종</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">모프</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">성별</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">부모</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">생일</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">나이</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">

                            @foreach($list as $item)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">
                                                {{$item->name}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{$item->type->name}}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{$item->morph}}
                                        </div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{$item->gender}}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{$item->father_name ?? "미확인"}} /
                                            {{$item->matehr_name ?? "미확인"}}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{$item->birth}}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{$item->age}}개월
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
