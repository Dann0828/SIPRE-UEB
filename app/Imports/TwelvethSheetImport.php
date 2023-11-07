<?php

namespace App\Imports;

use App\Models\Adquisicion;
use App\Models\Estadocomputador;
use App\Models\Modeloram;
use App\Models\Moduloram;
use App\Models\Ordenador;
use App\Models\Pantallacomputador;
use App\Models\Procesador;
use App\Models\Procesadorcomputador;
use App\Models\Sistemaoperativo;
use App\Models\Slotsram;
use App\Models\Tipocomputador;
use App\Models\Tipodd;
use App\Models\Ubicacion;
use App\Models\Versionso;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TwelvethSheetImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        return new Procesador([
		    'referencia' => $row['procesador'],
		    'frecuencia' => $row['frecuencia'],
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