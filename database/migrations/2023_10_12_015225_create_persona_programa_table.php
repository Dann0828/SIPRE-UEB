<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('persona_programa', function (Blueprint $table) {
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('programa_id');
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('persona')->onDelete('cascade');
            $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_programa');
    }
};
