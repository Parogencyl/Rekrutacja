<?php

namespace App\Repositories;

use App\Models\UserShift;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserShiftRepository extends AbstractRepository
{
    public function __construct(UserShift $userShift)
    {
        $this->model = $userShift;
    }

    public function getAllByCurrentDate(string $date): ?Collection
    {
        return $this->model->newQuery()
            ->with('estates')
            ->where('date_from', $date)
            ->orWhere('date_to', $date)
            ->get();
    }
}
