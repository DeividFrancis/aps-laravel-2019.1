<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("ocorrencia_tipo_id")->unsigned();
            $table->foreign("ocorrencia_tipo_id")
                ->references("id")
                ->on("ocorrencia_tipos")
                ->onDelete("cascade");
            $table->integer("situacao_id")->unsigned();
            $table->foreign("situacao_id")
                ->references("id")
                ->on("situacoes")
                ->onDelete("cascade");
            $table->integer("vacina_id")
                ->nullable()
                ->unsigned();
            $table->foreign("vacina_id")
                ->references("id")
                ->on("vacinas")
                ->onDelete("cascade");
            $table->float("venda_valor")->nullable();
            $table->string("observacao");
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
        Schema::dropIfExists('ocorrencias');
    }
}
