<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();
        Schema::create('plats', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prix');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('vegetarien_id');
            $table->foreign('vegetarien_id')
                ->references('id')
                ->on('vegetariens')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('poid');
            $table->string('origine');
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
        Schema::dropIfExists('plats');
    }
}
