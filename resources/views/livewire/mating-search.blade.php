<div>
    <div>
        <div class="mt-5 px-4">
            @include('parts.checkbox', ['title'=>"종 선택", 'list' => $typeList, 'type' => 'radio', 'name' => 'tid'])
        </div>

        <div class="px-4">
            <div class="max-w-[1280px] m-auto">
                <div class="grid grid-cols-2">
                    <div class="col-start-1 col-end-2 mr-2">
                        <div class="pt-5">
                            @include('parts.select-search2',[
                                'title' => "부 개체",
                                'list' => $fatherReptileList,
                                'identity' => 'fid',
                                'default' => '전체',
                                'selectListener' => 'fatherSelect',
                                'searchListener' => 'fatherSearch'
                            ])
                        </div>
                    </div>
                    <div class="col-start-2 col-end-3 ml-2">
                        <div class="pt-5">
                            @include('parts.select-search2', [
                                'title' => '모 개체',
                                'list' => $matherReptileList,
                                'identity' => 'mid',
                                'default' => '전체',
                                'selectListener' => 'matherSelect',
                                'searchListener' => 'matherSearch'
                        ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        @include('parts.list', [
            'list' => $matingList,
             'title' => '메이팅 이력',
             'headers' => ['부', '모', '설명', '메이팅일', '작성일', '수정일'],
             'datas' => ['father_name', 'mather_name', 'comment', 'mating_at', 'created_at', 'updated_at'],
         ])
    </div>
</div>
