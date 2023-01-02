<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Repositories\date;
use App\Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TodoRepository extends BaseRepository implements TodoRepositoryInterface
{
    public function __construct(Todo $todo)
    {
        parent::__construct($todo);
    }

    public function list($date)
    {
        return $this->model
            ->select(
                "id",
                "user_id",
                "name",
                "cycle",
                "started_at",
                "comment",
                DB::raw("DATEDIFF('$date', started_at ) as date_diff")
            )
            ->havingRaw('date_diff % todos.cycle = 0')
            ->get();
    }
}
