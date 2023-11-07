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
        Schema::create('perifericosyauxiliares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca_pa')->nullable();
            $table->string('modelo_pa')->nullable();
            $table->unsignedBigInteger('id_tipoaux');
            $table->foreign('id_tipoaux')->references('id')->on('tipoaux')->onDelete('cascade');
            $table->integer('valor');
            $table->unsignedBigInteger('id_estado')->nullable();
            $table->foreign('id_estado')->references('id')->on('estadoComputador')->onDelete('cascade');
            $table->unsignedBigInteger('id_localidad')->nullable();
            $table->foreign('id_localidad')->references('id')->on('localidad')->onDelete('cascade');
            $table->date('fecha_compra');
            $table->date('fecha_ven_garantia');

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