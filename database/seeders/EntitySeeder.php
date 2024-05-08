<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entities')->insert([
            'id' => 1,
            'name' => 'Gonzalo Network LLC',
            'email' => 'gonzaloproducciones1@hotmail.com',
            "logo" => "1.png",
            "icon" => "1.png",
            "city" => "New York",
            "address" => "41-01 108 st Corona ny 11368",
            "phone" => "3472582888",
            "cellphone" => "3472582888",
            "tax" => "0",
        ]);

        Entity::factory()->count(3)->create();
    }
}
