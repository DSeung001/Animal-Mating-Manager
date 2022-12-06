<div>
    <div>
        @include('parts.checkbox', [
            'title'=>"종 선택",
            'list' => $typeList,
            'type' => 'radio',
            'name' => 'tid',
            'changeListener' => 'typeChange'
        ])

        <div class="grid grid-cols-2">
            <div class="col-start-1 col-end-2 mr-2">
                @include('parts.select-search',[
                    'title' => "부 개체",
                    'list' => $fatherReptileList,
                    'identity' => 'father-reptile',
                    'default' => '미확인',
                    'searchListener' => 'fatherSearch'
                ])
            </div>
            <div class="col-start-2 col-end-3 ml-2">
                @include('parts.select-search', [
                    'title' => '모 개체',
                    'list' => $matherReptileList,
                    'identity' => 'mather-reptile',
                    'default' => '미확인',
                    'searchListener' => 'matherSearch'
                ])
            </div>
        </div>
    </div>
</div>
