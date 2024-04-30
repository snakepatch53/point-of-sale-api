<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infos')->insert([
            'name' => 'Gonzalo Network LLC',
            'email' => 'gonzaloproducciones1@hotmail.com',
            "logo" => "logo.png",
            "icon" => "icon.png",
            "city" => "New York",
            "address" => "41-01 108 st Corona ny 11368",
            "phone" => "3472582888",
            "cellphone" => "3472582888",
            "tax" => "0",
        ]);
    }
}


// php artisan migrate:fresh --seed