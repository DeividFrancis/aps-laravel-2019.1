<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animais', function (Blueprint $table) {
            $prefix = "";
            $table->increments($prefix . 'id');
            $table->integer("unidade_id")->unsigned();
            $table->foreign("unidade_id")
                ->references("id")
                ->on("unidades")
                ->onDelete("cascade");
            $table->integer("pessoa_id")->unsigned();
            $table->foreign("pessoa_id")
                ->references("id")
                ->on("pessoas")
                ->onDelete("cascade");
            $table->string("descricao");
            $table->string("codigo");
            $table->date("nascimento");
            $table->date("obito");
            $table->string("observacao");
            $table->string("sexo");
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
        Schema::dropIfExists('animais');
    }
}
