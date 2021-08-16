<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalCuidadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal__cuidadors', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id');
            $table->string('cuidador_id');
            $table->timestamps();
        });
        Schema::table('animal__cuidadors',function (Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animal')->onDelete('cascade');
            $table->foreign('cuidador_id')->references('id')->on('cuidador')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal__cuidadors');
    }
}
