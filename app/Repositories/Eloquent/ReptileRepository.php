<?php

namespace App\Repositories\Eloquent;

use App\Models\Reptile;
use App\Repositories\ReptileRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReptileRepository extends BaseRepository implements ReptileRepositoryInterface
{
    public function __construct(Reptile $model)
    {
        parent::__construct($model);
    }

    public function list($condition = [], $pagination = 10)
    {
        $list = $this->model
            ->select(
                'reptiles.id as id',
                DB::raw("
                reptiles.id AS id,
                reptiles.name AS name,
                reptiles.morph AS morph,
                types.name AS type,
                reptiles.gender AS gender,
                reptiles.status AS status,
                reptiles.father_id AS father_id,
                reptiles.mather_id AS mather_id,
                reptiles.birth AS birth,
                f_reptile.name AS father_name,
                m_reptile.name AS mather_name,
                TIMESTAMPDIFF(MONTH, reptiles.birth, now()) AS age
                "))
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'reptiles.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'reptiles.mather_id')
            ->leftJoin('types', 'types.id', '=', 'reptiles.type_id')
            ->orderBy("reptiles.created_at", "DESC")
            ->where('reptiles.user_id', Auth::id());

        foreach ($condition as $key => $value) {
            if (isset($value)) {
                if($key == 'reptiles.type_id'){
                    $list = $list->where($key, $value);
                }
                $list = $list->where($key, 'like', $value);
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

    public function belongType($typeId)
    {
        return $this->model->where('type_id', $typeId)->first() !== null;
    }

    public function getMaleReptilePluck($typeId = null)
    {
        $pluck = $this->model
            ->select("id", "name")
            ->where("user_id", Auth::id())
            ->where("gender", 'm');

        if (isset($typeId)) {
            $pluck = $pluck->where("type_id", $typeId);
        }

        return $pluck->pluck('name', 'id');
    }

    public function getFemaleReptilePluck($typeId = null)
    {
        $pluck = $this->model
            ->select("id", "name")
            ->where("user_id", Auth::id())
            ->where("gender", 'f');

        if (isset($typeId)) {
            $pluck = $pluck->where("type_id", $typeId);
        }

        return $pluck->pluck('name', 'id');
    }

    public function dataExists()
    {
        return $this->model->where('id', '!=', '0')->first() !== null;
    }

    public function getMaxCreatedAt()
    {
        return $this->model
            ->select(DB::raw('max(created_at) as created_at'))
            ->where('user_id', Auth::id())
            ->first()['created_at'];
    }

    public function getMinCreatedAt()
    {
        return $this->model
            ->select(DB::raw('min(created_at) as created_at'))
            ->where('user_id', Auth::id())
            ->first()['created_at'];
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

    public function getTypeChartList()
    {
        return $this->model
            ->select('types.name as name', 'types.name as drilldown', DB::raw('count(types.id) as y'))
            ->leftJoin('types', 'types.id', '=', 'type_id')
            ->where('reptiles.user_id', Auth::id())
            ->where('status', '!=', 'd')
            ->where('status', '!=', 's')
            ->groupBy('types.name')
            ->get();
    }
}
