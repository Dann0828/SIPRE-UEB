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
        Schema::create('salonOrdenador', function (Blueprint $table) {
            $table->unsignedBigInteger('salon_id');
            $table->unsignedBigInteger('ordenador_id');
            $table->timestamps();
            $table->foreign('salon_id')->references('id')->on('salon')->onDelete('cascade');
            $table->foreign('ordenador_id')->references('id')->on('ordenador')->onDelete('cascade');
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
