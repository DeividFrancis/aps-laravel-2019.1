<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $prefix = "";
            $table->increments($prefix.'id');
            $table->integer('unidade_id')->unsigned();
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onDelete('cascade');
            $table->string($prefix.'nomerazao');
            $table->string($prefix.'cpfCnpj');
            $table->string($prefix.'senha')->nullable();
            $table->string($prefix.'ie')->nullable();
            $table->string($prefix.'cep')->nullable();
            $table->string($prefix.'email1')->nullable();
            $table->string($prefix.'email2')->nullable();
            $table->string($prefix.'telefone1')->nullable();
            $table->string($prefix.'telefone2')->nullable();
            $table->integer($prefix.'principal')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa');
    }
}
