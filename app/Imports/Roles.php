<?php

namespace App\Imports;

use App\Models\Rol;
use App\Models\Tipoaux;
use App\Models\Tipocomputador;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Roles implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        return new Rol([
            'descripcion' => $row['rol'],
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