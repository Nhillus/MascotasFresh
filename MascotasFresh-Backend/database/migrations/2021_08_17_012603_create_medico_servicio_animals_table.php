<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoServicioAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_servicio_animals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('user_id');
            $table->date('fecha');
            $table->string('estatus')->default("pendiente");
            $table->timestamps();
        });
        Schema::table('medico_servicio_animals',function (Blueprint $table){
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medico_servicio_animals');
    }
}
