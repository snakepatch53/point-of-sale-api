<?php

namespace Database\Seeders;

use App\Models\ProductBuy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductBuy::factory()->count(5)->create();
    }
}
