<?php

namespace App\Repositories;

interface BlockReptileHistoryRepositoryInterface
{
    public function create($validated);

    public function delete($reptileId);

    /**
     * 달을 기준으로 카운팅
     * @return mixed
     */
    public function getCountByCreatedAt($createdAt);
}
