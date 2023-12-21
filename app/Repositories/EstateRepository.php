<?php

namespace App\Repositories;

use App\Models\Estate;
use Illuminate\Database\Eloquent\Collection;

class EstateRepository extends AbstractRepository
{
    public function __construct(Estate $estate)
    {
        $this->model = $estate;
    }

    public function getByIds(array $ids): ?Collection
    {
        return $this->model->newQuery()->whereIn('id', $ids)->get();
    }
}
