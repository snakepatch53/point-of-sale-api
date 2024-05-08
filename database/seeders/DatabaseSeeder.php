<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EntitySeeder::class,
            InfoSeeder::class,
            UserSeeder::class,
            LockerSeeder::class,
            SuplierSeeder::class,
            ClientSeeder::class,
            ProductSeeder::class,
            ProductBuySeeder::class,
            ProductInSeeder::class,
            ProductSaleSeeder::class,
            ProductOutSeeder::class,
        ]);
    }
}
