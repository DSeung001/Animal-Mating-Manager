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
                @if($isDefault)
                    @include('parts.select-search',[
                        'title' => "부 개체",
                        'list' => $maleReptilePluck,
                        'identity' => 'father_id',
                        'default' => '미확인',
                        'searchListener' => 'fatherSearch',
                        'selectedKey' => $fatherSelected ?? ''
                    ])
                @else
                    @include('parts.select-search',[
                        'title' => "부 개체",
                        'list' => $maleReptilePluck,
                        'identity' => 'father_id',
                        'searchListener' => 'fatherSearch',
                        'selectedKey' => $fatherSelected ?? ''
                    ])
                @endif
            </div>
            <div class="col-start-2 col-end-3 ml-2">
                @if($isDefault)
                    @include('parts.select-search', [
                        'title' => '모 개체',
                        'list' => $femaleReptilePluck,
                        'identity' => 'mather_id',
                        'default' => '미확인',
                        'searchListener' => 'matherSearch',
                        'selectedKey' => $matherSelected ?? ''
                    ])
                @else
                    @include('parts.select-search', [
                        'title' => '모 개체',
                        'list' => $femaleReptilePluck,
                        'identity' => 'mather_id',
                        'searchListener' => 'matherSearch',
                        'selectedKey' => $matherSelected ?? ''
                    ])
                @endif
            </div>
        </div>
    </div>
</div>
