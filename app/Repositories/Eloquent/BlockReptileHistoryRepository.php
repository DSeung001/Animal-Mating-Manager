<?php

namespace App\Repositories\Eloquent;

use App\Models\BlockReptileHistory;
use App\Repositories\BlockReptileHistoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlockReptileHistoryRepository implements BlockReptileHistoryRepositoryInterface
{

    protected $model;

    /**
     * @param $model
     */
    public function __construct(BlockReptileHistory $model)
    {
        $this->model = $model;
    }

    public function create($validated)
    {
        return $this->model->create($validated);
    }

    public function delete($reptileId)
    {
        return $this->model->where('user_id', Auth::id())->where('reptile_id', $reptileId)->delete();
    }

    public function getCountByCreatedAt($createdAt)
    {
        return $this->model
            ->select(DB::raw('count(id) as count'))
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $createdAt->format('Y-m')."-01 00:00:00")
            ->where('created_at', '<=', $createdAt->endOfMonth()->toDateString())
            ->first()['count'];
    }
}
