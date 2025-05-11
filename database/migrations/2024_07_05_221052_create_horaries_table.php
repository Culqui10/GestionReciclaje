<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horaries', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->time('starttime');
            $table->time('lasttime');
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->unsignedBigInteger('typemantenimiento_id');
            $table->foreign('typemantenimiento_id')->references('id')->on('typemantenimientos');
            $table->unsignedBigInteger('activitie_id');
            $table->foreign('activitie_id')->references('id')->on('activities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaries');
    }
};
