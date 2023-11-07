<?php

namespace App\Imports;

use App\Models\Edificio;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Edificios implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        return new Edificio([
            'descripcion' => $row['edificio'],
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