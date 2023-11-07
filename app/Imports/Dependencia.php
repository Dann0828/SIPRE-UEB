<?php

namespace App\Imports;

use App\Models\Dependenciaua;
use App\Models\Tipoareaua;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Dependencia implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        $tipoarea = Tipoareaua::where('descripcion', $row['area'])->first();


        return new Dependenciaua([
            'dependencia' => $row['dependencia'],
            'areaua_id' => $tipoarea ? $tipoarea->id : null,
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