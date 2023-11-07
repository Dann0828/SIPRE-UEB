<?php

namespace App\Imports;


use App\Models\SalonOrdenador;
use App\Models\Salon;
use App\Models\Ordenador;
use App\Models\Edificio;
use App\Models\Tipoaula;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrdenadorSalon implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        
        $edificio = Edificio::where('descripcion', $row['edificio'])->first();
        $tipoEdificio = Tipoaula::where('descripcion', $row['tipo_aula'])->first();
        
        // Initialize $salon variable with a default value
        $salon = null;

        if ($edificio && $tipoEdificio) {
            $salon = Salon::where('descripcion', $row['aula'])
                ->where('edificio_id', $edificio->id)   
                ->where('tipoaula_id', $tipoEdificio->id)
                ->first();
        }

        $ordenador = Ordenador::where('nombreRed', $row['nombre_red'])->first();
        
        return new SalonOrdenador([
        'salon_id'     => $salon ? $salon->id : null,
        'ordenador_id' => $ordenador ? $ordenador->id : null,
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