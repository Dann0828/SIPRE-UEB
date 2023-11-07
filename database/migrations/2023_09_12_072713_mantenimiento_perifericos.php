<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mantenimientoperiferico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('perifericos_id');
            $table->foreign('perifericos_id')->references('id')->on('perifericosyauxiliares')->onDelete('cascade');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_tipo_mantenimiento');
            $table->foreign('id_tipo_mantenimiento')->references('id')->on('tipoMantenimiento')->onDelete('cascade');
            $table->string('descripcion');
            $table->datetime('fecha');
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
