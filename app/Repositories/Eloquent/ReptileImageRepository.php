<?php

namespace App\Repositories\Eloquent;

use App\Models\ReptileImage;
use App\Repositories\ReptileImageRepositoryInterface;

class ReptileImageRepository implements ReptileImageRepositoryInterface
{
    protected $model;

    public function __construct(ReptileImage $model)
    {
        $this->model = $model;
    }

    public function create($validated)
    {
        return $this->model->create($validated);
    }

    public function update($reptileId, $validated)
    {
        return $this->model->where('reptile_id', $reptileId)->update($validated);
    }

    public function delete($reptileId)
    {
        return $this->model->where('reptile_id', $reptileId)->delete();
    }

    public function getOne($reptileId)
    {
        return $this->model->where('reptile_id', $reptileId)->first();
    }
}
