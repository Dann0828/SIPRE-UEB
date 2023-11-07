<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportarComputador implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
            2 => new ThirdSheetImport(),
            3 => new FourthSheetImport(),
            4 => new FifthSheetImport(),
            5 => new SixthSheetImport(),
            6 => new SeventhSheetImport(),
            7 => new EigthSheetImport(),
            8 => new NinethSheetImport(),
            9 => new TenthSheetImport(),
            10 => new EleventhSheetImport(),
            11 => new TwelvethSheetImport(),
            12 => new ThirteenSheetImport(),
            13 => new FourtheenSheetImport(),
        ];
    }


}