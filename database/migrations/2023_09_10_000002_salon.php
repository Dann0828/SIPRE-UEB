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
        Schema::create('salon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('edificio_id');
            $table->foreign('edificio_id')->references('id')->on('edificio')->onDelete('cascade');
            $table->unsignedBigInteger('tipoaula_id');
            $table->foreign('tipoaula_id')->references('id')->on('tipoaula')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
