<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected Model $model;

    public function save(Model $model): void
    {
        $model->save();
    }

    public function getAll(): ?Collection
    {
        return $this->model->newQuery()->get();
    }
}
