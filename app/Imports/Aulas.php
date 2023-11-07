<?php

namespace App\Imports;

use App\Models\Edificio;
use App\Models\EstadoComputador;
use App\Models\Localidad;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Rol;
use App\Models\Salon;
use App\Models\Tipoaula;
use App\Models\Tipoaux;
use App\Models\Perifericosyauxiliare;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Aulas implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        $edifcio_id = Edificio::where('descripcion', $row['edificio'])->first();
        $tipoaula = Tipoaula::where('descripcion', $row['tipo_aula'])->first();


        return new Salon([
            'edificio_id' => $edifcio_id ? $edifcio_id->id:null,
            'tipoaula_id' => $tipoaula ? $tipoaula->id:null,
            'descripcion' => $row['aula'],
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