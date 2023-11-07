<?php

namespace App\Imports;

use App\Models\EstadoComputador;
use App\Models\Localidad;
use App\Models\Tipoaux;
use App\Models\Perifericosyauxiliare;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class perifericosAuxiliares implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        $tipoaux = Tipoaux::where('tipo_aux', $row['tipo'])->first();
        $estado = EstadoComputador::where('estado_computador', $row['estado'])->first();
        $localidad = Localidad::where('nombreEdificio',$row['nombre_edificio'])
                                ->where('tipoArea',$row['tipo_area'])
                                ->where('nombreDependencia',$row['nombre_dependencia'])
                                ->first();
        $valorNumerico = $row['vencimiento_garantia'];
        $fechaBase = strtotime('1900-01-01');
        $fecha_ven_garantia = date('Y-m-d', strtotime("+$valorNumerico days", $fechaBase));
        $valorNumerico1 = $row['fecha_compra'];
        $fechaCompra = date('Y-m-d', strtotime("+$valorNumerico1 days", $fechaBase));


        return new Perifericosyauxiliare([
            'marca_pa' => $row['marca'],
            'modelo_pa' => $row['modelo'],
            'id_tipoaux' => $tipoaux ? $tipoaux->id:null,
            'valor'=> $row['valor'],
            'id_estado'=> $estado?$estado -> id:null,
            'id_localidad'=> $localidad?$localidad->id:null,
            'fecha_compra' => $fechaCompra,
            'fecha_ven_garantia' => $fecha_ven_garantia,
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