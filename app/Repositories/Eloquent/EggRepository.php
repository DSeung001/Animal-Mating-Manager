<?php

namespace App\Repositories\Eloquent;

use App\Models\Egg;
use App\Repositories\EggRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EggRepository extends BaseRepository implements EggRepositoryInterface
{
    protected $model;

    public function __construct(Egg $model)
    {
        parent::__construct($model);
    }

    public function list($condition = [], $pagination = 10)
    {
        $list = $this->model
            ->select(
                'eggs.id as id',
                'spawn_at',
                DB::raw("DATE_ADD(spawn_at, INTERVAL hatch_day DAY) as estimated_date"),
                'is_hatching',
                'types.name as type_name',
                'f_reptile.name as father_name',
                'm_reptile.name as mather_name'
            )
            ->leftJoin('types', 'types.id', '=', 'type_id')
            ->leftJoin('matings', 'matings.id', '=', 'mating_id')
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->orderByRaw('FIELD (is_hatching, \'w\',\'y\', \'n\') DESC')
            ->where('eggs.user_id', Auth::id());

        foreach ($condition as $key => $value) {
            if (isset($value)) {
                $list = $list->where($key, $value);
            }
        }

        if ($pagination == 'all') {
            return $list->get();
        } else {
            return $list->paginate($pagination);
        }
    }

    public function belongMating($matingId)
    {
        return $this->model->where('mating_id', $matingId)->first() !== null;
    }

    public function getHatchingScheduled()
    {
        $hatchingScheduled = $this->model
            ->select(
                'eggs.id as id',
                'f_reptile.name as father_name',
                'm_reptile.name as mather_name',
                DB::raw("DATE_ADD(spawn_at, INTERVAL hatch_day DAY) as start"))
            ->leftJoin('types', 'types.id', '=', 'type_id')
            ->leftJoin('matings', 'matings.id', '=', 'mating_id')
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->where('eggs.user_id', Auth::id())
            ->get()
            ->toArray();

        $hatchingScheduled = array_map(function ($item){
            return [
                'title' => $item['father_name']."x".$item['mather_name']." 알",
                'url' => route('egg.show',$item['id']),
                'start' => $item['start']
            ];
        }, $hatchingScheduled);

        return $hatchingScheduled;
    }
}
