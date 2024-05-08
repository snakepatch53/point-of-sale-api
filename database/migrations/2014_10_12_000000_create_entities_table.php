<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("logo");
            $table->string("icon");
            $table->string("city");
            $table->string("address");
            $table->string("phone");
            $table->string("cellphone");
            $table->string("email");
            $table->string("tax");

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entities');
    }
};
