<?php

namespace App\Console\Commands;

use App\Models\UserShift;
use App\Repositories\EstateRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserShiftRepository;
use Carbon\Carbon;
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
        $today = Carbon::now()->format('Y-m-d');
        $userShifts = $this->userShiftRepository->getAllByCurrentDate($today);

        /** @var UserShift $userShifts */
        foreach ($userShifts as $userShift) {
            if ($userShift->date_from === $today) {
                foreach ($userShift->estates as $estate) {
                    $estate->supervisor_user_id = $userShift->substitute_user_id;
                    $this->estateRepository->save($estate);

                }
                $userShift->temp_changes = [
                    'estates' => $userShift->estates?->pluck('id'),
                    'user_id' => $userShift->user_id,
                ];

                $this->userShiftRepository->save($userShift);

                continue;
            }

            $estates = $this->estateRepository->getByIds($userShift->temp_changes['estates']);

            foreach ($estates as $estate) {
                $estate->supervisor_user_id = $userShift->temp_changes['user_id'];
                $this->estateRepository->save($estate);

            }
            $userShift->temp_changes = $userShift;

            $this->userShiftRepository->save($userShift);
        }
    }
}
