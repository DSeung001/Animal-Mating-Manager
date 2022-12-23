<?php

namespace App\Repositories;

interface ReptileImageRepositoryInterface
{
    public function create($validated);

    public function update($reptileId, $validated);

    public function delete($reptileId);

    public function getOne($reptileId);
}
