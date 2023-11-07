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
        Schema::create('dependenciaua', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dependencia')->nullable();
            $table->unsignedBigInteger('areaua_id');
            $table->foreign('areaua_id')->references('id')->on('tipoareaua')->onDelete('cascade');
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