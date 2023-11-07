<?php

namespace App\Imports;

use App\Models\Tipoareaua;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TipoArea implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        return new Tipoareaua([
            'descripcion' => $row['area'],
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