<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unidade_id')->unsigned();
            $table->foreign('unidade_id')->references("id")->on('unidades');

            $table->integer('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references("id")->on('pessoas');

            $table->integer('animal_id')->unsigned();
            $table->foreign('animal_id')->references("id")->on('animais');

            $table->integer('vacina_tipo_id')->unsigned();
            $table->foreign('vacina_tipo_id')->references("id")->on('vacina_tipos');

            $table->date('data')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacinas');
    }
}
