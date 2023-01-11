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
            ->orderBy("created_at", "DESC")
            ->where('user_id', Auth::id());

        foreach ($condition as $key => $value) {
            if (isset($value)) {
                $list = $list->where($key, 'like', "%".$value."%");
            }
        }

        $items = [
            'length' => $list->count()
        ];

        if ($pagination == 'all') {
            $items['list'] = $list->get();
        } else {
            $items['list'] = $list->paginate($pagination);
        }
        return $items;
    }

    public function getTypePluck()
    {
        return $this->model
            ->select('id', 'name')
            ->listByUserId(Auth::id())
            ->pluck('name', 'id');
    }
}
