<?php

namespace Database\Seeders;

use App\Models\ProductIn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductIn::factory()->count(5)->create();
    }
}
