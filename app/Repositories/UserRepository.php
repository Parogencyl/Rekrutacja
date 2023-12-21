<?php

namespace App\Repositories;

use App\Models\UserShift;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends AbstractRepository
{
    public function __construct(UserShift $userShift)
    {
        $this->model = $userShift;
    }
}
