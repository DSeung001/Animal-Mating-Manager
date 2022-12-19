<?php

namespace App\Observers;

use App\Models\reptile;

class ReptileObserver
{
    private $reptileModifyHistory;

    public function __construct(ReptileModifyHistory $reptileModifyHistory){
        $this->reptileModifyHistory = $reptileModifyHistory;

        \Log::info("짜란");
    }

    /**
     * Handle the reptile "updated" event.
     *
     * @param  \App\Models\reptile  $reptile
     * @return void
     */
    public function updated(reptile $reptile)
    {
        // 히스토리 쌓기
        \Log::info($reptile);
    }

    /**
     * Handle the reptile "deleted" event.
     *
     * @param  \App\Models\reptile  $reptile
     * @return void
     */
    public function deleted(reptile $reptile)
    {
        // 해당 렙타일 삭제시 관련 히스토리 전체 삭제
        \Log::info($reptile);
    }
}
