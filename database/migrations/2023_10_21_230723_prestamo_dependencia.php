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
        Schema::create('prestamo_dependencia', function (Blueprint $table) {
            $table->unsignedBigInteger('prestamo_id');
            $table->unsignedBigInteger('dependenciaua_id');
            $table->timestamps();
            $table->foreign('prestamo_id')->references('id')->on('prestamo')->onDelete('cascade');
            $table->foreign('dependenciaua_id')->references('id')->on('dependenciaua')->onDelete('cascade');
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
