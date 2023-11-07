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
        Schema::create('ordenador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->unsignedBigInteger('id_tipoComputador')->nullable();
            $table->foreign('id_tipoComputador')->references('id')->on('tipoComputador')->onDelete('cascade');
            $table->unsignedBigInteger('id_tipoAdquisicion')->nullable();
            $table->foreign('id_tipoAdquisicion')->references('id')->on('tipoAdquisicion')->onDelete('cascade');
            $table->unsignedBigInteger('id_slotsRam')->nullable();
            $table->foreign('id_slotsRam')->references('id')->on('slotsRam')->onDelete('cascade');
            $table->string('serie')->nullable();
            $table->bigInteger('valor')->nullable();
            $table->date('fecha_compra')->nullable();
            $table->date('fecha_vencimiento_garantia')->nullable();
            $table->string('placa_inventario')->nullable();
            $table->string('perifericos_adicionales')->nullable();
            $table->unsignedBigInteger('id_sistemaoperativo')->nullable();
            $table->foreign('id_sistemaoperativo')->references('id')->on('sistemaOperativo')->onDelete('cascade');
            $table->string('marca_pantalla')->nullable();
            $table->string('modelo_pantalla')->nullable();
            $table->string('serial_pantalla')->nullable();
            $table->integer('pulgadas')->nullable();
            $table->unsignedBigInteger('id_tipo_pantalla')->nullable();
            $table->foreign('id_tipo_pantalla')->references('id')->on('tipoPantalla')->onDelete('cascade');
            $table->unsignedBigInteger('id_procesador')->nullable();
            $table->foreign('id_procesador')->references('id')->on('procesador')->onDelete('cascade');
            $table->string('espacio_disco_duro')->nullable();
            $table->unsignedBigInteger('id_tipo_discoDuro')->nullable();
            $table->foreign('id_tipo_discoDuro')->references('id')->on('tipoDiscoDuro')->onDelete('cascade');
            $table->unsignedBigInteger('id_modeloRam')->nullable();
            $table->foreign('id_modeloRam')->references('id')->on('tipoRam')->onDelete('cascade');
            $table->string('espacioRam')->nullable();
            $table->date('fecha_asignacion')->nullable()->nullable();
            $table->unsignedBigInteger('id_tipoAsignacion')->nullable();
            $table->foreign('id_tipoAsignacion')->references('id')->on('tipoAsignacionLocalidad')->onDelete('cascade');
            $table->unsignedBigInteger('id_estado')->nullable();
            $table->foreign('id_estado')->references('id')->on('estadoComputador')->onDelete('cascade');
            $table->unsignedBigInteger('id_localidad')->nullable();
            $table->foreign('id_localidad')->references('id')->on('localidad')->onDelete('cascade');
            $table->unsignedBigInteger('id_usuarios')->nullable();
            $table->foreign('id_usuarios')->references('id')->on('rolComputador')->onDelete('cascade');
            $table->string('nombreRed')->nullable();
            $table->string('usuarioDominio')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('direccionMacL')->nullable();
            $table->string('direccionMacW')->nullable();
            $table->string('descripcionDiscoDuro',2000)->nullable();
            $table->string('softwareLicenciado',2000)->nullable();
            $table->string('softwareLibre',2000)->nullable();
            $table->string('usuario')->nullable();
            $table->string('cargo')->nullable();
            $table->string('extension')->nullable();
            $table->string('correoInstitucional')->nullable();



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