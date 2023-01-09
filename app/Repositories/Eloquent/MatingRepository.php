<?php

namespace App\Repositories\Eloquent;

use App\Models\Mating;
use App\Repositories\MatingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatingRepository extends BaseRepository implements MatingRepositoryInterface
{
    public function __construct(Mating $model)
    {
        parent::__construct($model);
    }

    public function list($condition = [], $pagination = 10)
    {
        $list = $this->model->select(
            'matings.id as id',
            'matings.type_id as type_id',
            'f_reptile.name AS father_name',
            'm_reptile.name AS mather_name',
            'mating_at',
            'matings.created_at AS created_at',
            'matings.updated_at AS updated_at'
        )
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->orderBy("matings.created_at", "DESC")
            ->where('matings.user_id', Auth::id());

        foreach ($condition as $key => $value) {
            if (isset($value)) {
                if ($key === 'mating_at' || $key === 'matings.id') {
                    $list->where($key, $value);
                    continue;
                }
                $list = $list->where($key, 'like', $value);
            }
        }

        if ($pagination == 'all') {
            return $list->get();
        } else {
            return $list->paginate($pagination);
        }
    }

    public function belongReptile($id)
    {
        return !empty($this->model->where('father_id', $id)->orWhere('mather_id', $id)->first());
    }
}
