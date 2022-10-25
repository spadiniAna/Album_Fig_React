<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('figurinhas_pacotes', function (Blueprint $table) {
            $table->increments("id");

            $table->integer("id_figurinha");
            $table->integer("id_pacote");
            $table->foreign('id_figurinha')->references('id')->on('figurinhas')->onDelete('cascade');
            $table->foreign('id_pacote')->references('id')->on('pacotes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};