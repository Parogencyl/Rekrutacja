<?php

namespace App\Repositories;

use App\Models\Estate;

class EstateRepository extends AbstractRepository
{
    public function __construct(Estate $estate)
    {
        $this->model = $estate;
    }
}
