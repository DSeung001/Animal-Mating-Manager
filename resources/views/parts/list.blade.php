{{--
    $title : 제목
    $headers : th 텍스트 표시 값
    $datas : td 텍스트 표시 값
    $list : ul li에 출력 데이터 리스트
    $decorator : li 데이터에 데코레이션 문자 붙이기
    $name : form으로 보낼 이름 값 | option | $listName과 같이 사용
    $listColumn : radio input (선택 박스)에서 사용할 값의 컬럼명 | option | $name과 같이 사용
    $isWrapper : wrapper 여부 | option
--}}

@if( !(isset($isWrapper) && !$isWrapper))
    <section class="antialiased bg-gray-100 text-gray-600 px-4">
        <div class="flex flex-col mt-5">
            <div class="w-full max-w-[1280px] mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                @endif
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
                                @if(isset($listColumn))
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">선택</div>
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">

                            @forelse($list as $item)
                                @if(isset($showRoute))
                                    <tr onclick="location.href='{{route($showRoute, $item->id)}}'" class="cursor-pointer hover:bg-gray-200">
                                @else
                                    <tr>
                                @endif
                                    @foreach($datas as $value)
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-gray-800">
                                                    {{$item[$value]}}{{$decorator[$value] ?? ''}}
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach

                                    @if(isset($listColumn))
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-gray-800">
                                                    <input type="radio" name="{{$name}}"
                                                           value="{{$item[$listColumn]}}">
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-2 whitespace-nowrap"
                                        colspan="{{ isset($listColumn) ? count($headers) + 1 : count($headers) }}">
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
                @if( !(isset($isWrapper) && !$isWrapper))
            </div>
        </div>
    </section>
@endif

