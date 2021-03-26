<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandePlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_plats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')
                ->references('id')
                ->on('commandes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('plat_id');
            $table->foreign('plat_id')
                ->references('id')
                ->on('plats')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('quantite');
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
        Schema::dropIfExists('commande__plats');
    }
}
