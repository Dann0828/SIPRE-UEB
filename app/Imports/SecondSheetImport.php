<?php

namespace App\Imports;

use App\Models\TipoAdquisicion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SecondSheetImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        return new TipoAdquisicion([
            'tipo_adquisicion' => $row['adquisicion'],
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
