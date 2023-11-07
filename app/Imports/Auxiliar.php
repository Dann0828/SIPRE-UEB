<?php

namespace App\Imports;

use App\Models\Tipoaux;
use App\Models\Tipocomputador;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Auxiliar implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        return new Tipoaux([
            'tipo_aux' => $row['auxiliar'],
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