<?php

namespace App\Console\Commands;

use App\Models\UserShift;
use App\Repositories\EstateRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserShiftRepository;
use Illuminate\Console\Command;

class CheckSupervisorsForEstatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-supervisors-for-estates';

    public function __construct(
        private readonly UserShiftRepository $userShiftRepository,
        private readonly EstateRepository $estateRepository,
    ) {
        parent::__construct();
    }

    protected $description = 'Check supervisors for estates';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $comingBackUsers = $this->userShiftRepository->getComingBackUsers();

        /** @var UserShift $comingBackUser */
        foreach ($comingBackUsers as $comingBackUser) {
            $estate = $comingBackUser->estate;
            $estate->supervisor_user_id = $comingBackUser->user_id;

            $this->estateRepository->save($estate);
        }
    }
}
