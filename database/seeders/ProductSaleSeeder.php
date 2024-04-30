<?php

namespace Database\Seeders;

use App\Models\ProductSale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSale::factory()->count(5)->create();
    }
}
