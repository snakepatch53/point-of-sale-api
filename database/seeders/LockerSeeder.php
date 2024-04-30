<?php

namespace Database\Seeders;

use App\Models\Locker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LockerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locker::factory()->count(5)->create();
    }
}
