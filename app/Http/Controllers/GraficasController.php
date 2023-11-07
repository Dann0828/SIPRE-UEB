<?php

namespace App\Http\Controllers;
use App\Models\Ordenador;
use App\Models\Prestamop;
use App\Models\Prestamo;
use App\Models\Perifericosyauxiliare;
use App\Models\MantenimientoOrdenador;
use App\Models\Mantenimientoperiferico;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Facultad;
use App\Models\TipoComputador;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class GraficasController extends Controller
{
    public function graficoOrdenadores(){
        $ordenadoresTipos = Ordenador::selectRaw('COALESCE(tipoComputador.tipo_computador, "Sin identificar") as tipo_computador, COUNT(ordenador.id) as cantidad_computadoras')
                        ->leftJoin('tipoComputador', 'ordenador.id_tipoComputador', '=', 'tipoComputador.id')
                        ->groupBy('tipoComputador.tipo_computador')
                        ->get();
        $ordenadoresAsignacion = Ordenador::selectRaw('COALESCE(tipoAsignacionLocalidad.tipoAsignacion, "Sin identificar") as asignacion, COUNT(ordenador.id) as cantidad_computadoras')
        ->leftJoin('tipoAsignacionLocalidad', 'ordenador.id_tipoAsignacion', '=', 'tipoAsignacionLocalidad.id')
        ->groupBy('tipoAsignacionLocalidad.tipoAsignacion')
        ->get();
        $ordenadoresEstado = Ordenador::selectRaw('COALESCE(estadoComputador.estado_computador, "Sin identificar") as estado, COUNT(ordenador.id) as cantidad_computadoras')
        ->leftJoin('estadoComputador', 'ordenador.id_estado', '=', 'estadoComputador.id')
        ->groupBy('estadoComputador.estado_computador')
        ->get();
        $ordenadoresRam = Ordenador::selectRaw('COALESCE(tipoRam.tipoRam, "Sin identificar") as ram, COUNT(ordenador.id) as cantidad_computadoras')
        ->leftJoin('tipoRam', 'ordenador.id_modeloRam', '=', 'tipoRam.id')
        ->groupBy('tipoRam.tipoRam')
        ->get();
        $ordenadoresDisco = Ordenador::selectRaw('COALESCE(tipoDiscoDuro.tipoDiscoDuro, "Sin identificar") as disco, COUNT(ordenador.id) as cantidad_computadoras')
        ->leftJoin('tipoDiscoDuro', 'ordenador.id_tipo_discoDuro', '=', 'tipoDiscoDuro.id')
        ->groupBy('tipoDiscoDuro.tipoDiscoDuro')
        ->get();
        $ordenadoresSistemaO = Ordenador::selectRaw('COALESCE(sistemaOperativo.sistema_operativo, "Sin identificar") as sistema, COUNT(ordenador.id) as cantidad_computadoras')
        ->leftJoin('sistemaOperativo', 'ordenador.id_sistemaoperativo', '=', 'sistemaOperativo.id')
        ->groupBy('sistemaOperativo.sistema_operativo')
        ->get();

        

        $cantidadOrdenadores = Ordenador::count();
        $cantidadPerifericos = Perifericosyauxiliare::count();
        
        


    
        $puntos = [];
    
        foreach($ordenadoresTipos as $ordenador){
            $puntos[] = ['name' => $ordenador->tipo_computador, 'y' => $ordenador->cantidad_computadoras];
        }

        foreach($ordenadoresAsignacion as $ordenador){
            $puntos1[] = ['name' => $ordenador->asignacion, 'y' => $ordenador->cantidad_computadoras];
        }
        foreach($ordenadoresEstado as $ordenador){
            $puntos2[] = ['name' => $ordenador->estado, 'y' => $ordenador->cantidad_computadoras];
        }
        foreach($ordenadoresRam as $ordenador){
            $puntos3[] = ['name' => $ordenador->ram, 'y' => $ordenador->cantidad_computadoras];
        }
        foreach($ordenadoresDisco as $ordenador){
            $puntos4[] = ['name' => $ordenador->disco, 'y' => $ordenador->cantidad_computadoras];
        }
        foreach($ordenadoresSistemaO as $ordenador){
            $puntos5[] = ['name' => $ordenador->sistema, 'y' => $ordenador->cantidad_computadoras];
        }

    
        return view("graficos.graficos", ["data" => $puntos, "cantidadOrdenadores" => $cantidadOrdenadores,"data1"=>$puntos1,"data2"=>$puntos2,"data3"=>$puntos3,"data4"=>$puntos4,"data5"=>$puntos5,"cantidadOrdenadores" => $cantidadOrdenadores, "cantidadPerifericos"=>$cantidadPerifericos]);
    }
    
    public function graficosPersonas()
    {
    $personasPorRol = DB::table('rol')
                    ->leftJoin('persona_rol', 'rol.id', '=', 'persona_rol.rol_id')
                    ->leftJoin('persona', 'persona_rol.persona_id', '=', 'persona.id')
                    ->select('rol.id', 'rol.descripcion as rol', DB::raw('COUNT(persona.id) as cantidad_personas'))
                    ->groupBy('rol.id', 'rol.descripcion')
                    ->get();
    $personasPorPrograma = Programa::leftJoin('persona_programa', 'programa.id', '=', 'persona_programa.programa_id')
                            ->select('programa.id as programa_id', 'programa.nombre as programa', DB::raw('COUNT(persona_programa.persona_id) as cantidad_personas'))
                            ->groupBy('programa.id', 'programa.nombre')
                             ->get();

    $personasPorFacultad = Facultad::leftJoin('programa', 'facultad.id', '=', 'programa.facultad_id')
                             ->leftJoin('persona_programa', 'programa.id', '=', 'persona_programa.programa_id')
                             ->select('facultad.id as facultad_id', 'facultad.nombre as facultad', DB::raw('COUNT(DISTINCT persona_programa.persona_id) as cantidad_personas'))
                             ->groupBy('facultad.id', 'facultad.nombre')
                             ->get();
                         
                         

    $puntos = [];

    foreach ($personasPorRol as $personaporrol) {
        $puntos[] = ['name' => $personaporrol->rol, 'y' => $personaporrol->cantidad_personas];
    }
    foreach ($personasPorPrograma as $personaporprgrama) {
        $puntos1[] = ['name' => $personaporprgrama->programa, 'y' => $personaporprgrama->cantidad_personas];
    }
    foreach ($personasPorFacultad as $personasPorFacultad) {
        $puntos2[] = ['name' => $personasPorFacultad->facultad, 'y' => $personasPorFacultad->cantidad_personas];
    }

    return view("graficos.graficos1", ["data" => $puntos, "data1" => $puntos1, "data2" => $puntos2]);
    }


    public function graficosPerifericos(){

        $perifericosTipos = Perifericosyauxiliare::selectRaw('COALESCE(tipoaux.tipo_aux, "Sin identificar") as tipo, COUNT(perifericosyauxiliares.id) as cantidad_perifericos')
        ->leftJoin('tipoaux', 'perifericosyauxiliares.id_tipoaux', '=', 'tipoaux.id')
        ->groupBy('tipoaux.tipo_aux')
        ->get();

        $perifericosEstado = Perifericosyauxiliare::selectRaw('COALESCE(estadoComputador.estado_computador, "Sin identificar") as estado, COUNT(perifericosyauxiliares.id) as cantidad_perifericos')
        ->leftJoin('estadoComputador', 'perifericosyauxiliares.id_estado', '=', 'estadoComputador.id')
        ->groupBy('estadoComputador.estado_computador')
        ->get();

        $cantidadOrdenadores = Ordenador::count();
        $cantidadPerifericos = Perifericosyauxiliare::count();



        $puntos = [];
        foreach ($perifericosTipos as $perifericosTipo) {
                $puntos[] = ['name' => $perifericosTipo->tipo, 'y' => $perifericosTipo->cantidad_perifericos];
        }
        foreach ($perifericosEstado as $perifericoEstado) {
            $puntos1[] = ['name' => $perifericoEstado->estado, 'y' => $perifericoEstado->cantidad_perifericos];
        }
     
        return view("graficos.graficos2",["data" => $puntos,"data1" => $puntos1, "cantidadOrdenadores" => $cantidadOrdenadores, "cantidadPerifericos"=>$cantidadPerifericos]);
    }

    public function graficosMantenimientosOrdenador(){
        $mantenimientoPorEncargado = MantenimientoOrdenador::selectRaw('COALESCE(users.name, "Sin identificar") as encargado, COUNT(mantenimiento_ordenador.id) as cantidad_mantenimientos')
        ->leftJoin('users', 'mantenimiento_ordenador.users_id', '=', 'users.id')
        ->groupBy('users.name')
        ->get();
        $mantenimientoPorTipo = MantenimientoOrdenador::selectRaw('COALESCE(tipoMantenimiento.descripcion, "Sin identificar") as tipo, COUNT(mantenimiento_ordenador.id) as cantidad_mantenimientos')
        ->leftJoin('tipoMantenimiento', 'mantenimiento_ordenador.id_tipo_mantenimiento', '=', 'tipoMantenimiento.id')
        ->groupBy('tipoMantenimiento.descripcion')
        ->get();
        $mantenimientoPorTipoCambio = MantenimientoOrdenador::selectRaw('COALESCE(tipoCambio.descripcion, "Sin identificar") as tipo, COUNT(mantenimiento_ordenador.id) as cantidad_mantenimientos')
        ->leftJoin('tipoCambio', 'mantenimiento_ordenador.id_tipocambio', '=', 'tipoCambio.id')
        ->groupBy('tipoCambio.descripcion')
        ->get();
        $mantenimientoPorFecha= DB::table('mantenimiento_ordenador')
        ->select(DB::raw('DATE_FORMAT(fecha, "%m") as mes'), DB::raw('COUNT(*) as cantidad_mantenimientos'))
        ->groupBy(DB::raw('DATE_FORMAT(fecha, "%m")'))
        ->get();
        $mantenimientoPortipoP =  DB::table('tipoComputador')
            ->select('tipoComputador.tipo_computador as tipoc', DB::raw('COUNT(mantenimiento_ordenador.id) as cantidad_mantenimientos'))
            ->leftJoin('ordenador', 'tipoComputador.id', '=', 'ordenador.id_tipoComputador')
            ->leftJoin('mantenimiento_ordenador', 'ordenador.id', '=', 'mantenimiento_ordenador.ordenador_id')
            ->groupBy('tipoComputador.tipo_computador')
            ->get();

        $mantenimientoOrdenador = MantenimientoOrdenador::count();
        $mantenimientoperiferico = Mantenimientoperiferico::count();
        $puntos = [];
        foreach ($mantenimientoPorEncargado as $mantE) {
                $puntos[] = ['name' => $mantE->encargado, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos1 = [];
        foreach ($mantenimientoPorTipo as $mantE) {
            $puntos1[] = ['name' => $mantE->tipo, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos2 = [];
        foreach ($mantenimientoPorTipoCambio as $mantE) {
            $puntos2[] = ['name' => $mantE->tipo, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos3 = [];
        foreach ($mantenimientoPorFecha as $mantE) {
            $puntos3[] = ['name' => $mantE->mes, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos4 = [];
        foreach ($mantenimientoPortipoP as $mantE) {
            $puntos4[] = ['name' => $mantE->tipoc, 'y' => $mantE->cantidad_mantenimientos];
        }
        
        return view("graficos.graficos3",["data" => $puntos, "data1" => $puntos1, "data2" => $puntos2, "data3" => $puntos3, "data4" => $puntos4,"mantenimientoOrdenador" => $mantenimientoOrdenador, "mantenimientoperiferico" => $mantenimientoperiferico]);
    }

    public function graficosMantenimientosPerifericos(){
        $mantenimientoPPorEncargado = Mantenimientoperiferico::selectRaw('COALESCE(users.name, "Sin identificar") as encargado, COUNT(mantenimientoperiferico.id) as cantidad_mantenimientos')
        ->leftJoin('users', 'mantenimientoperiferico.users_id', '=', 'users.id')
        ->groupBy('users.name')
        ->get();
        $mantenimientoPorTipo = Mantenimientoperiferico::selectRaw('COALESCE(tipoMantenimiento.descripcion, "Sin identificar") as tipo, COUNT(mantenimientoperiferico.id) as cantidad_mantenimientos')
        ->leftJoin('tipoMantenimiento', 'mantenimientoperiferico.id_tipo_mantenimiento', '=', 'tipoMantenimiento.id')
        ->groupBy('tipoMantenimiento.descripcion')
        ->get();
        $mantenimientoPorFecha= DB::table('mantenimientoperiferico')
        ->select(DB::raw('DATE_FORMAT(fecha, "%m") as mes'), DB::raw('COUNT(*) as cantidad_mantenimientos'))
        ->groupBy(DB::raw('DATE_FORMAT(fecha, "%m")'))
        ->get();
        $mantenimientoPortipoP =  DB::table('tipoaux')
            ->select('tipoaux.tipo_aux as tipop', DB::raw('COUNT(mantenimientoperiferico.id) as cantidad_mantenimientos'))
            ->leftJoin('perifericosyauxiliares', 'tipoaux.id', '=', 'perifericosyauxiliares.id_tipoaux')
            ->leftJoin('mantenimientoperiferico', 'perifericosyauxiliares.id', '=', 'mantenimientoperiferico.perifericos_id')
            ->groupBy('tipoaux.tipo_aux')
            ->get();
        
        $mantenimientoOrdenador = MantenimientoOrdenador::count();
        $mantenimientoperiferico = Mantenimientoperiferico::count();
        $puntos = [];
        foreach ($mantenimientoPPorEncargado as $mantE) {
                $puntos[] = ['name' => $mantE->encargado, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos1 = [];
        foreach ($mantenimientoPorTipo as $mantE) {
            $puntos1[] = ['name' => $mantE->tipo, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos2 = [];
        foreach ($mantenimientoPorFecha as $mantE) {
            $puntos2[] = ['name' => $mantE->mes, 'y' => $mantE->cantidad_mantenimientos];
        }
        $puntos3 = [];
        foreach ($mantenimientoPortipoP as $mantE) {
            $puntos3[] = ['name' => $mantE->tipop, 'y' => $mantE->cantidad_mantenimientos];
        }
       
        return view("graficos.graficos4",["data" => $puntos, "data1" => $puntos1, "data2" => $puntos2,"data3" => $puntos3, "mantenimientoOrdenador" => $mantenimientoOrdenador, "mantenimientoperiferico" => $mantenimientoperiferico]);
    }

    public function prestamoPerifericos(){
        $prestamosPorEstado = Prestamop::select('estado', \DB::raw('COUNT(*) as cantidad_prestamos'))
            ->groupBy('estado')
            ->get();
        $prestamosPorUser = DB::table('users')
            ->leftJoin('prestamop', 'users.id', '=', 'prestamop.users_id')
            ->select('users.name as user_id', DB::raw('COUNT(prestamop.id) as cantidad_prestamos'))
            ->groupBy('users.name')
            ->get();
        $prestamosPorTipoEquipo = DB::table('tipoaux')
            ->leftJoin('perifericosyauxiliares', 'tipoaux.id', '=', 'perifericosyauxiliares.id_tipoaux')
            ->leftJoin('prestamop', 'perifericosyauxiliares.id', '=', 'prestamop.perifericosyauxiliares_id')
            ->select('tipoaux.tipo_aux as tipo', DB::raw('COUNT(prestamop.id) as cantidad_prestamos'))
            ->groupBy('tipoaux.tipo_aux')
            ->get();

        $prestamosPorEdificio = DB::table('edificio')
            ->leftJoin('salon', 'edificio.id', '=', 'salon.edificio_id')
            ->leftJoin('prestamop', 'salon.id', '=', 'prestamop.salon_id')
            ->select('edificio.descripcion as edificio', DB::raw('COUNT(prestamop.id) as cantidad_prestamos'))
            ->groupBy('edificio.descripcion')
            ->orderByDesc('cantidad_prestamos')
            ->limit(8)
            ->get();
        
        $prestamosPorFacultad = DB::table('facultad')
        ->leftJoin('programa', 'facultad.id', '=', 'programa.facultad_id')
        ->leftJoin('prestamop_programa', 'programa.id', '=', 'prestamop_programa.programa_id')
        ->leftJoin('prestamop', 'prestamop_programa.prestamop_id', '=', 'prestamop.id')
        ->select('facultad.nombre AS facultad', DB::raw('COUNT(prestamop.id) AS cantidad_prestamos'))
        ->groupBy('facultad.nombre')
        ->orderByDesc('cantidad_prestamos')
        ->get();

        $prestamosPorPrograma = DB::table('programa')
                ->leftJoin('prestamop_programa', 'programa.id', '=', 'prestamop_programa.programa_id')
                ->leftJoin('prestamop', 'prestamop_programa.prestamop_id', '=', 'prestamop.id')
                ->select('programa.nombre AS programa', DB::raw('COUNT(prestamop.id) AS cantidad_prestamos'))
                ->groupBy('programa.nombre')
                ->orderByDesc('cantidad_prestamos')
                ->limit(8)
                ->get();

        $prestamosPorRol = DB::table('prestamop')
            ->join('persona', 'prestamop.persona_id', '=', 'persona.id')
            ->join('persona_rol', 'persona.id', '=', 'persona_rol.persona_id')
            ->join('rol', 'persona_rol.rol_id', '=', 'rol.id')
            ->select('rol.descripcion as rol', DB::raw('COUNT(prestamop.id) as cantidad_prestamos'))
            ->groupBy('rol.descripcion')
            ->orderByDesc('cantidad_prestamos')
            ->limit(5)
            ->get();

        $prestamoFecha= DB::table('prestamop')
            ->select(DB::raw('DATE_FORMAT(fecha_hora_prestamo, "%m") as mes'), DB::raw('COUNT(*) as cantidad_prestamos'))
            ->groupBy(DB::raw('DATE_FORMAT(fecha_hora_prestamo, "%m")'))
            ->get();

        $prestamosPorDependencia = DB::table('dependenciaua')
            ->leftJoin('prestamop_dependencia', 'dependenciaua.id', '=', 'prestamop_dependencia.dependenciaua_id')
            ->leftJoin('prestamop', 'prestamop_dependencia.prestamop_id', '=', 'prestamop.id')
            ->select('dependenciaua.dependencia AS dependencia', DB::raw('COUNT(prestamop.id) AS cantidad_prestamos'))
            ->groupBy('dependenciaua.dependencia')
            ->orderByDesc('cantidad_prestamos')
            ->limit(8)
            ->get();

        $prestamosPorArea = DB::table('tipoareaua')
            ->leftJoin('dependenciaua', 'tipoareaua.id', '=', 'dependenciaua.areaua_id')
            ->leftJoin('prestamop_dependencia', 'dependenciaua.id', '=', 'prestamop_dependencia.dependenciaua_id')
            ->leftJoin('prestamop', 'prestamop_dependencia.prestamop_id', '=', 'prestamop.id')
            ->select('tipoareaua.descripcion AS area', DB::raw('COUNT(prestamop.id) AS cantidad_prestamos'))
            ->groupBy('tipoareaua.descripcion')
            ->orderByDesc('cantidad_prestamos')
            ->limit(8)
            ->get();
        
        // Ahora $prestamosPorDependencia contiene las 8 dependencias con más préstamos
        
            
        $prestamosOrdTotales = Prestamo::count();
        $prestamosPerTotales = Prestamop::count();

        foreach($prestamosPorEstado as $prestamop){
            $puntos[] = ['name' => $prestamop->estado, 'y' => $prestamop->cantidad_prestamos];
        }
        foreach($prestamosPorUser as $prestamop){
            $puntos1[] = ['name' => $prestamop->user_id, 'y' => $prestamop->cantidad_prestamos];
        }
        foreach($prestamosPorTipoEquipo as $prestamop){
            $puntos2[] = ['name' => $prestamop->tipo, 'y' => $prestamop->cantidad_prestamos];
        }
        foreach($prestamosPorEdificio as $prestamop){
            $puntos3[] = ['name' => $prestamop->edificio, 'y' => $prestamop->cantidad_prestamos];
        }
        $puntos4 = [];
        foreach($prestamosPorFacultad as $prestamop){
            $puntos4[] = ['name' => $prestamop->facultad, 'y' => $prestamop->cantidad_prestamos];
        }
        $puntos5 = [];
        foreach($prestamosPorPrograma as $prestamop){
            $puntos5[] = ['name' => $prestamop->programa, 'y' => $prestamop->cantidad_prestamos];
        }
        $puntos6 = [];  
        foreach($prestamosPorRol as $prestamop){
            $puntos6[] = ['name' => $prestamop->rol, 'y' => $prestamop->cantidad_prestamos];
        }
        $puntos7 = [];  
        foreach($prestamoFecha as $prestamop){
            $puntos7[] = ['name' => $prestamop->mes, 'y' => $prestamop->cantidad_prestamos];
        }
        $puntos8 = [];  
        foreach($prestamosPorDependencia as $prestamop){
            $puntos8[] = ['name' => $prestamop->dependencia, 'y' => $prestamop->cantidad_prestamos];
        }
        $puntos9 = [];  
        foreach($prestamosPorArea as $prestamop){
            $puntos9[] = ['name' => $prestamop->area, 'y' => $prestamop->cantidad_prestamos];
        }
                
        return view("graficos.graficos6",["data" => $puntos, "data1" => $puntos1, "data2" => $puntos2,"data3" => $puntos3,"data4" => $puntos4,"data5" => $puntos5,"data6" => $puntos6,"data7" => $puntos7,"data8" => $puntos8,"data9" => $puntos9, "prestamosOrdTotales" => $prestamosOrdTotales, "prestamosPerTotales" => $prestamosPerTotales]);
    }

    public function prestamoOrdenadores(){
	
            $prestamosPorEstado = Prestamo::select('estado', \DB::raw('COUNT(*) as cantidad_prestamos'))
                ->groupBy('estado')
                ->get();
            $prestamosPorUser = DB::table('users')
                ->leftJoin('prestamo', 'users.id', '=', 'prestamo.users_id')
                ->select(DB::raw('users.name as user_id'), DB::raw('COUNT(prestamo.id) as cantidad_prestamos'))
                ->groupBy('users.name')
                ->get();
            
            $prestamosPorTipoEquipo = DB::table('tipoComputador')
                ->leftJoin('ordenador', 'tipoComputador.id', '=', 'ordenador.id_tipoComputador')
                ->leftJoin('prestamo', 'ordenador.id', '=', 'prestamo.equipo_id')
                ->select('tipoComputador.tipo_computador as tipo', DB::raw('COUNT(prestamo.id) as cantidad_prestamos'))
                ->groupBy('tipoComputador.tipo_computador')
                ->get();
            $prestamosPorEdificio = DB::table('edificio')
                ->leftJoin('salon', 'edificio.id', '=', 'salon.edificio_id')
                ->leftJoin('prestamo', 'salon.id', '=', 'prestamo.salon_id')
                ->select('edificio.descripcion as edificio', DB::raw('COUNT(prestamo.id) as cantidad_prestamos'))
                ->groupBy('edificio.descripcion')
                ->orderByDesc('cantidad_prestamos')
                ->limit(5)
                ->get();
            
            $prestamosPorFacultad = DB::table('facultad')
                ->leftJoin('programa', 'facultad.id', '=', 'programa.facultad_id')
                ->leftJoin('prestamo_programa', 'programa.id', '=', 'prestamo_programa.programa_id')
                ->leftJoin('prestamo', 'prestamo_programa.prestamo_id', '=', 'prestamo.id')
                ->select('facultad.nombre AS facultad', DB::raw('COUNT(prestamo.id) AS cantidad_prestamos'))
                ->groupBy('facultad.nombre')
                ->orderByDesc('cantidad_prestamos')
                ->get();
    
            $programas = DB::table('programa')
                ->leftJoin('prestamo_programa', 'programa.id', '=', 'prestamo_programa.programa_id')
                ->leftJoin('prestamo', 'prestamo_programa.prestamo_id', '=', 'prestamo.id')
                ->select('programa.nombre AS programa', DB::raw('COUNT(prestamo.id) AS cantidad_prestamos'))
                ->groupBy('programa.nombre')
                ->orderByDesc('cantidad_prestamos')
                ->limit(8)
                ->get();
            
    
            $prestamosPorRol = DB::table('prestamo')
                ->join('persona', 'prestamo.persona_id', '=', 'persona.id')
                ->join('persona_rol', 'persona.id', '=', 'persona_rol.persona_id')
                ->join('rol', 'persona_rol.rol_id', '=', 'rol.id')
                ->select('rol.descripcion as rol', DB::raw('COUNT(prestamo.id) as cantidad_prestamos'))
                ->groupBy('rol.descripcion')
                ->orderByDesc('cantidad_prestamos')
                ->limit(5)
                ->get();
    
            $prestamoFecha= DB::table('prestamo')
                ->select(DB::raw('DATE_FORMAT(fecha_hora_prestamo, "%m") as mes'), DB::raw('COUNT(*) as cantidad_prestamos'))
                ->groupBy(DB::raw('DATE_FORMAT(fecha_hora_prestamo, "%m")'))
                ->get();

            $prestamosPorDependencia = DB::table('dependenciaua')
                ->leftJoin('prestamo_dependencia', 'dependenciaua.id', '=', 'prestamo_dependencia.dependenciaua_id')
                ->leftJoin('prestamo', 'prestamo_dependencia.prestamo_id', '=', 'prestamo.id')
                ->select('dependenciaua.dependencia AS dependencia', DB::raw('COUNT(prestamo.id) AS cantidad_prestamos'))
                ->groupBy('dependenciaua.dependencia')
                ->orderByDesc('cantidad_prestamos')
                ->limit(8)
                ->get();

            $prestamosPorArea = DB::table('tipoareaua')
                ->leftJoin('dependenciaua', 'tipoareaua.id', '=', 'dependenciaua.areaua_id')
                ->leftJoin('prestamo_dependencia', 'dependenciaua.id', '=', 'prestamo_dependencia.dependenciaua_id')
                ->leftJoin('prestamo', 'prestamo_dependencia.prestamo_id', '=', 'prestamo.id')
                ->select('tipoareaua.descripcion AS area', DB::raw('COUNT(prestamo.id) AS cantidad_prestamos'))
                ->groupBy('tipoareaua.descripcion')
                ->orderByDesc('cantidad_prestamos')
                ->limit(8)
                ->get();
            

            $prestamosOrdTotales = Prestamo::count();
            $prestamosPerTotales = Prestamop::count();

                foreach($prestamosPorEstado as $prestamo){
                    $puntos[] = ['name' => $prestamo->estado, 'y' => $prestamo->cantidad_prestamos];
                }
                foreach($prestamosPorUser as $prestamo){
                    $puntos1[] = ['name' => $prestamo->user_id, 'y' => $prestamo->cantidad_prestamos];
                }
                foreach($prestamosPorTipoEquipo as $prestamo){
                    $puntos2[] = ['name' => $prestamo->tipo, 'y' => $prestamo->cantidad_prestamos];
                }
                foreach($prestamosPorEdificio as $prestamo){
                    $puntos3[] = ['name' => $prestamo->edificio, 'y' => $prestamo->cantidad_prestamos];
                }
                $puntos4 = [];
                foreach($prestamosPorFacultad as $prestamo){
                    $puntos4[] = ['name' => $prestamo->facultad, 'y' => $prestamo->cantidad_prestamos];
                }
                $puntos5 = [];
                foreach($programas as $prestamop){
                    $puntos5[] = ['name' => $prestamop->programa,  'y' => $prestamop->cantidad_prestamos];
                }
                $puntos6 = [];  
                foreach($prestamosPorRol as $prestamop){
                    $puntos6[] = ['name' => $prestamop->rol, 'y' => $prestamop->cantidad_prestamos];
                }
                $puntos7 = [];  
                foreach($prestamoFecha as $prestamop){
                    $puntos7[] = ['name' => $prestamop->mes, 'y' => $prestamop->cantidad_prestamos];
                }
                $puntos8 = [];  
                foreach($prestamosPorDependencia as $prestamop){
                    $puntos8[] = ['name' => $prestamop->dependencia, 'y' => $prestamop->cantidad_prestamos];
                }
                $puntos9 = [];  
                foreach($prestamosPorArea as $prestamop){
                    $puntos9[] = ['name' => $prestamop->area, 'y' => $prestamop->cantidad_prestamos];
                }
                
                return view("graficos.graficos6",["data" => $puntos, "data1" => $puntos1, "data2" => $puntos2,"data3" => $puntos3,"data4" => $puntos4,"data5" => $puntos5,"data6" => $puntos6,"data7" => $puntos7,"data8" => $puntos8,"data9" => $puntos9, "prestamosOrdTotales" => $prestamosOrdTotales, "prestamosPerTotales" => $prestamosPerTotales]);
          }
    }
    
    
    
   
