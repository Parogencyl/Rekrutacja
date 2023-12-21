<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\User;
use App\Models\UserShift;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetFakeData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 2) as $item) {
            User::query()->insert(['user_firstname' => $faker->userName(), 'user_lastname' => $faker->lastName()]);
        }

        $users = User::all();

        UserShift::query()->insert([
            'user_id' => $users->first()->user_id,
            'substitute_user_id' => $users->last()->user_id,
            'date_from' => Carbon::create(2022, 3, 1),
            'date_to' => Carbon::create(2022, 4, 2),
        ]);

        $userShift = UserShift::all();

        foreach (range(1, 50) as $item) {
            Estate::query()->insert([
                'supervisor_user_id' => $users->random()->user_id,
                'user_shift_id' => rand(0, 1) ? $userShift->random()->id : null,
                'street' => $faker->streetName(),
                'building_number' => $faker->buildingNumber(),
                'city' => $faker->city(),
                'zip' => $faker->postcode(),
            ]);
        }
    }
}
