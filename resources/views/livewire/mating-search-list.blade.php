<div>
    <div>
        @include('parts.checkbox', [
            'title'=>"종 선택",
            'list' => $typeList,
            'type' => 'radio',
            'name' => 'type_id',
            'changeListener' => 'typeChange',
            'selectedKey' => $typeSelected ?? ''
        ])

        <div class="grid grid-cols-2">
            <div class="col-start-1 col-end-2 mr-2">
                @include('parts.select-search',[
                    'title' => "부 개체",
                    'list' => $fatherReptileList,
                    'identity' => 'father_id',
                    'default' => '전체',
                    'selectListener' => 'fatherSelect',
                    'searchListener' => 'fatherSearch',
                    'selectedKey' => $fatherSelected ?? ''
                ])
            </div>
            <div class="col-start-2 col-end-3 ml-2">
                @include('parts.select-search', [
                    'title' => '모 개체',
                    'list' => $matherReptileList,
                    'identity' => 'mather_id',
                    'default' => '전체',
                    'selectListener' => 'matherSelect',
                    'searchListener' => 'matherSearch',
                    'selectedKey' => $matherSelected ?? ''
                ])
            </div>
        </div>
    </div>

    @include('parts.list', [
         'list' => $matingList,
         'title' => '메이팅 이력',
         'headers' => ['부', '모', '설명', '메이팅일'],
         'datas' => ['father_name', 'mather_name', 'comment', 'mating_at'],
         'name' => 'mating_id',
         'radioColumn' => 'id',
         'radioSelectedId' => $matingIdSelected,
         'isWrapper' => false
     ])
</div>
