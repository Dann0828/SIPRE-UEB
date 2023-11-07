<?php

namespace App\Imports;

use App\Models\TipoComputador;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        return new TipoComputador([
            'tipo_computador' => $row['tipos'],
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