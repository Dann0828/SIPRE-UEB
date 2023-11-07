<?php

namespace App\Imports;

use App\Models\EstadoComputador;
use App\Models\Localidad;
use App\Models\Ordenador;
use App\Models\Procesador;
use App\Models\RolComputador;
use App\Models\SistemaOperativo;
use App\Models\SlotsRam;
use App\Models\TipoAdquisicion;
use App\Models\TipoAsignacionLocalidad;
use App\Models\TipoComputador;
use App\Models\TipoDiscoDuro;
use App\Models\TipoPantalla;
use App\Models\TipoRam;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FourtheenSheetImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{


    public function model(array $row)
    {
        $tipoComputador = TipoComputador::where('tipo_computador', $row['tipo'])->first();
        $tipoAdquisicion = TipoAdquisicion::where('tipo_adquisicion', $row['adquisicion'])->first();
        $tipoPantalla = TipoPantalla::where('tipoPantalla', $row['tipo_pantalla'])->first();
        $tipoRam = TipoRam::where('tipoRam', $row['modelo_ram'])->first();
        $tipoDiscoDuro = TipoDiscoDuro::where('tipoDiscoDuro', $row['tipo_disco'])->first();
        $estado = EstadoComputador::where('estado_computador', $row['estado'])->first();
        $tipoAsignacion = TipoAsignacionLocalidad::where('tipoAsignacion', $row['tipo_asignacion'])->first();
        $rolComputador = RolComputador::where('rol',$row['tipo_usuario'])->first();
        $slotRam = SlotsRam::where('slotsRam',$row['slots'])
                             ->where('descripcion',$row['modulos'])
                             ->first();
        $sistemaOperativo = SistemaOperativo::where('sistema_operativo',$row['sistema'])
                             ->where('version',$row['version'])
                             ->first();
        $localidad = Localidad::where('nombreEdificio',$row['nombre_edificio'])
                                ->where('tipoArea',$row['tipo_area'])
                                ->where('nombreDependencia',$row['nombre_dependencia'])
                                ->first();
        $procesador = Procesador::where('referencia',$row['procesador'])
                                ->where('frecuencia',$row['frecuencia'])
                                ->first();
        $valorNumerico = $row['fecha_asignacion'];
        $fechaBase = strtotime('1900-01-01');
        $fechaAsignada = date('Y-m-d', strtotime("+$valorNumerico days", $fechaBase));
        $valorNumerico1 = $row['fecha_compra'];
        $fechaCompra = date('Y-m-d', strtotime("+$valorNumerico1 days", $fechaBase));
        $valorNumerico2 = $row['vencimiento_garantia'];
        $fechaGarantia = date('Y-m-d', strtotime("+$valorNumerico2 days", $fechaBase));
        $serialPantalla = $row['serial_pantalla'];

        return new Ordenador([
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'id_tipoComputador' => $tipoComputador ? $tipoComputador->id:null,
            'id_tipoAdquisicion'=> $tipoAdquisicion ? $tipoAdquisicion->id:null,
            'serie'=> $row['serie'],
            'placa_inventario'=> $row['placa_inventario'],
            'valor' => $row['valor'],
            'fecha_compra' => $fechaCompra,
            'fecha_vencimiento_garantia' => $fechaGarantia,
            'perifericos_adicionales' => $row['adicionales'],
            'id_sistemaoperativo' => $sistemaOperativo ? $sistemaOperativo->id:null,
            'id_procesador'  => $procesador ? $procesador->id:null,
            'serial_pantalla'=> $serialPantalla,
            'marca_pantalla'=> $row['marca_pantalla'],
            'modelo_pantalla'=> $row['modelo_pantalla'],
            'pulgadas' => (int)str_replace('"', '', $row['pulgadas_pantalla']),
            'id_tipo_pantalla' => $tipoPantalla ? $tipoPantalla->id:null,
            'espacioRam'=>  $row['espacio_ram'],
            'id_slotsRam'=> $slotRam?$slotRam->id:null,
            'id_modeloRam'=> $tipoRam ? $tipoRam->id:null,
            'espacio_disco_duro'=> $row['disco_duro'],
            'id_tipo_discoDuro' => $tipoDiscoDuro ? $tipoDiscoDuro->id:null,
            'id_estado'=> $estado ? $estado->id:null,
            'id_tipoAsignacion'=> $tipoAsignacion ? $tipoAsignacion->id:null,
            'id_localidad'=> $localidad ? $localidad->id:null,
            'id_usuarios'=> $rolComputador ? $rolComputador->id:null,
            'fecha_asignacion' => $fechaAsignada,
            'nombreRed' => $row['nombre_red'],
            'usuarioDominio' => $row['usuario_dominio'],
            'observaciones' => $row['observaciones'],
            'direccionMacL' => $row['mac_lan'],
            'direccionMacW' => $row['mac_wifi'],
            'descripcionDiscoDuro' => $row['descripcion_disco_duro'],
            'softwareLicenciado' => $row['software_licenciado'],
            'softwareLibre' => $row['software_libre'],
            'usuario' => $row['usuario'],
            'cargo' => $row['cargo'],
            'extension' => $row['extension'],
            'correoInstitucional' => $row['correo_institucional'],


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