<?php

namespace App\Imports;

use App\Models\EstadoComputador;
use App\Models\Facultad;
use App\Models\Localidad;
use App\Models\Programa;
use App\Models\Tipoaux;
use App\Models\Perifericosyauxiliare;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Programas implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        $facultad_id = Facultad::where('nombre', $row['facultad'])->first();


        return new Programa([
            'nombre' => $row['nombre'],
            'facultad_id' => $facultad_id ? $facultad_id->id : null,
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