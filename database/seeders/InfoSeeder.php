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
            'name' => 'Ideasoft Sell',
            'email' => 'ideasoftdev@gmail.com',
            "logo" => "1.png",
            "icon" => "1.png",
            "city" => "Macas",
            "address" => "Barrio 27 de Febrero",
            "phone" => "0959999086",
            "cellphone" => "0959999086",
            "tax" => "0",
        ]);
    }
}


// php artisan migrate:fresh --seed