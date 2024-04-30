<?php

namespace Database\Seeders;

use App\Models\ProductOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductOut::factory()->count(5)->create();
    }
}
