<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function create($validated = []);

    public function update($id, $validated = []);

    public function delete($id);

    public function getOne($id, $columns = "*");
}
