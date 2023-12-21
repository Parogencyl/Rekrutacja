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

    public function getComingBackUsers(): ?Collection
    {
        return $this->model->newQuery()
            ->with(['estate'])
            ->where([
                'date_to' => Carbon::now()->format('Y-m-d'),
            ])
            ->get();
    }
}
