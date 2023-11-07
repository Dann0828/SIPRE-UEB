<?php

namespace App\Imports;

use App\Models\EstadoComputador;
use App\Models\Localidad;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Rol;
use App\Models\Tipoaux;
use App\Models\Perifericosyauxiliare;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Personas implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        $programa_id = Programa::where('nombre', $row['programa'])->first();
        $rol_id = Rol::where('descripcion', $row['rol'])->first();


        return new Persona([
            'id' => $row['cedula'],
            'nombre' => $row['nombre'],
            'correo' => $row['correo'],
            'celular'=> $row['celular'],
            'programa_id'=> $programa_id?$programa_id -> id:null,
            'rol_id'=> $rol_id?$rol_id->id:null,
            'estado' => $row['estado'],
        ]);
    }
       public function chunkSize(): int
    {
        return 1000;
    }
    public function batchSize(): int
    {
        return 1000;
    }
}