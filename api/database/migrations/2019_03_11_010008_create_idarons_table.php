<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Animal;
class CreateIdaronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idarons', function (Blueprint $table) {
            $femea = "f_";
            $macho = "m_";
            $table->increments('id');
            $table->integer("unidade_id")->unsigned();
            $table->foreign("unidade_id")->references("id")->on("unidades");
            $table->integer("pessoa_digitado_id")->unsigned();
            $table->foreign("pessoa_digitado_id")->references("id")->on("pessoas");
            $table->string("descricao");
            $table->date("cadastro");
            $table->integer($macho.Animal::G_0006);
            $table->integer($femea.Animal::G_0006);
            $table->integer($macho.Animal::G_0612);
            $table->integer($femea.Animal::G_0612);
            $table->integer($macho.Animal::G_1224);
            $table->integer($femea.Animal::G_1224);
            $table->integer($macho.Animal::G_2436);
            $table->integer($femea.Animal::G_2436);
            $table->integer($macho.Animal::G_3699);
            $table->integer($femea.Animal::G_3699);
            $table->string("observacao")->nullable();
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
        Schema::dropIfExists('idarom');
    }
}
