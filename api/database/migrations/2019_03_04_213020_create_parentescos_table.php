<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentescosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentescos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("pai_id")
                ->nullable()
                ->unsigned();
            $table->foreign("pai_id")
                ->references("id")
                ->on("animais")
                ->onDelete("cascade");
            $table->integer("mae_id")
                ->nullable()
                ->unsigned();
            $table->foreign("mae_id")
                ->references("id")
                ->on("animais")
                ->onDelete("cascade");
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
        Schema::dropIfExists('parentescos');
    }
}
