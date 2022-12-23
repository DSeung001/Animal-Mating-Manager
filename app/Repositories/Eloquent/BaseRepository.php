<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    /**
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($validated = [])
    {
        return $this->model->create($validated);
    }

    public function update($id, $validated = [])
    {
        return $this->model
            ->where('id', $id)
            ->update($validated);
    }

    public function delete($id)
    {
        return $this->model
            ->where('id', $id)
            ->delete();
    }

    public function getOne($id, $columns = "*"){
        return $this->model
            ->select(DB::raw($columns))
            ->where('id', $id)
            ->first();
    }
}
