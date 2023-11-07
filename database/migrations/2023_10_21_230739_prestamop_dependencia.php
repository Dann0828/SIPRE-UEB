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
        Schema::create('prestamop_dependencia', function (Blueprint $table) {
            $table->unsignedBigInteger('prestamop_id');
            $table->unsignedBigInteger('dependenciaua_id');
            $table->timestamps();
            $table->foreign('prestamop_id')->references('id')->on('prestamop')->onDelete('cascade');
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
