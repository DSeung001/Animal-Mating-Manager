<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Repositories\date;
use App\Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
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
                "comment"
            )
            ->where('user_id', Auth::id())
            ->where('started_at', '<=', $date)
            ->orderBy("created_at", "DESC")
            ->whereRaw(DB::raw("DATEDIFF('$date', started_at ) % todos.cycle = 0"))
            ->get();
    }
}
