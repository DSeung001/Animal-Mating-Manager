{{--
    $title : 제목
    $headers : th 텍스트 표시 값
    $datas : td 텍스트 표시 값
    $list : ul li에 출력 데이터 리스트
    $decorator : li 데이터에 데코레이션 문자 붙이기
    $selectKey : radio input을 추가하고, 이에 대한 이름 값
--}}

<section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
    <div class="flex flex-col h-full mt-5">
        <!-- Table -->
        <div class="w-full max-w-[1280px] mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800 ml-3">
                    {{$title}}
                </h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            @foreach($headers as $value)
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">{{$value}}</div>
                                </th>
                            @endforeach
                            @if(isset($selectKey))
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">선택</div>
                                </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">

                        @forelse($list as $item)
                            <tr>
                                @foreach($datas as $value)
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">
                                                {{$item[$value]}}{{$decorator[$value] ?? ''}}
                                            </div>
                                        </div>
                                    </td>
                                @endforeach

                                @if(isset($selectKey))
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">
                                                <input type="radio" name="{{$selectKey}}" value="{{$item[$selectKey]}}">
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td class="p-2 whitespace-nowrap" colspan="{{count($headers)}}">
                                    <div class="font-medium text-gray-800 text-center">
                                        비어있음
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
