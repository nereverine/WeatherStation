<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::table('users', function (Blueprint $table) {
            $table->enum('type', ['SO', 'N']);
            //SO "Station Owner" - admin da estacao; N "Normal" - só pode ver valores
            $table->softDeletes();
        });

        

        Schema::create('sensors', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('photo_url')->nullable();
        });

        Schema::create('stationsensors', function (Blueprint $table){
            $table->id();
            $table->bigInteger('sensorId')->unsigned();
            $table->foreign('sensorId')->references('id')->on('sensors');
        });

        Schema::create('stations', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->bigInteger('sensors')->unsigned();
            $table->foreign('sensors')->references('id')->on('stationsensors');
            $table->enum('status', ['A', 'I']);
            //A- ACTIVE; I-INACTIVE
            $table->bigInteger('ownerId')->unsigned();
            $table->foreign('ownerId')->references('id')->on('users');
        });

        Schema::create('datalogging',function (Blueprint $table){
            $table->bigInteger('id')->unsigned()->primary();
            $table->bigInteger('stationId')->unsigned();
            $table->foreign('stationId')->references('id')->on('stations');
            $table->bigInteger('sensorId')->unsigned();
            $table->foreign('sensorId')->references('id')->on('sensors');
            $table->dateTime('logged_at');
            $table->float('value',3,2);
        });

        
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
        Schema::dropIfExists('sensors');
        Schema::dropIfExists('stationsensors');
        Schema::dropIfExists('datalogging');
        Schema::table('users', function ($table) {
            $table->dropColumn(['type', 'deleted_at']);
        });
    }
}