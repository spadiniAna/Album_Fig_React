<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('figurinhas', function (Blueprint $table) {
            $table->increments("id");

            $table->string("nome", 100);
            $table->string("foto", 255);
            $table->date("data_nasc");
            $table->string("naturalidade", 155);
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};