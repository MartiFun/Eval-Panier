<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientPlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();
        Schema::create('ingredient_plat', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('ingredient_id');
          $table->foreign('ingredient_id')
              ->references('id')
              ->on('ingredients')
              ->onDelete('cascade')
              ->onUpdate('cascade');
          $table->unsignedBigInteger('plat_id');
          $table->foreign('plat_id')
              ->references('id')
              ->on('plats')
              ->onDelete('cascade')
              ->onUpdate('cascade');

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
        Schema::dropIfExists('ingredient__plats');
    }
}
