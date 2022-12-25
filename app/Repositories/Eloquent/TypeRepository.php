<?php

namespace App\Repositories\Eloquent;

use App\Models\Type;
use App\Repositories\TypeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    public function __construct(Type $model)
    {
        parent::__construct($model);
    }

    public function list($condition = [], $pagination = 10)
    {
        $list = $this->model
            ->select('id', 'name', 'hatch_day', 'created_at', 'updated_at')
            ->where('user_id', Auth::id());

        foreach ($condition as $key => $value) {
            if (isset($value)) {
                $list = $list->where($key, 'like', "%".$value."%");
            }
        }

        if ($pagination == 'all') {
            return $list->get();
        } else {
            return $list->paginate($pagination);
        }
    }

    public function getTypePluck()
    {
        return $this->model
            ->select('id', 'name')
            ->listByUserId(Auth::id())
            ->pluck('name', 'id');
    }
}
