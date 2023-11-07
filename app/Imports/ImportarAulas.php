<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportarAulas implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new TipoAulas(),
            1 => new Edificios(),
            2 => new Aulas()
        ];
    }


}