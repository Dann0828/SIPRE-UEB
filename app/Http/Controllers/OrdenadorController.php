<?php

namespace App\Http\Controllers;

use App\Models\EstadoComputador;
use App\Models\Localidad;
use App\Models\MantenimientoOrdenador;
use App\Models\Ordenador;
use App\Models\Prestamo;
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
use App\Models\TipoSoftwareComputador;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class OrdenadorController
 * @package App\Http\Controllers
 */
class OrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenadors = Ordenador::paginate();

        return view('ordenador.index', compact('ordenadors'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenadors->perPage());
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Ordenador::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $ordenadors = $query->paginate();
        $ordenadors->appends(['busqueda' => $busqueda]);
        return view('ordenador.index', compact('ordenadors'));
    }


    public function pdfsininfo($id){

        $ordenador = Ordenador::where('id', $id)->get();

        if ($ordenador->isEmpty()) {
            return redirect()->route('ordenador.index')
            ->with('error', 'No se puede generar el PDF');
        }
        $pdf = Pdf::loadView('ordenador.pdf1', compact('ordenador'));
        return $pdf->stream();
    }

    public function pdfprestamo($id){

        $prestamo = Prestamo::where('equipo_id', $id)->get();
        $ordenador = Ordenador::where('id', $id)->get();

        if ($prestamo->isEmpty()) {
            return redirect()->route('ordenador.index')
            ->with('error', 'No se puede generar el PDF, el equipo no cuenta con préstamos');
        }
        $pdf = Pdf::loadView('ordenador.pdf2', compact('ordenador','prestamo'));
        return $pdf->stream();
    }

    public function pdfmantenimiento($id){

        $mantenimiento = MantenimientoOrdenador::where('ordenador_id', $id)->get();
        $ordenador = Ordenador::where('id', $id)->get();

        if ($mantenimiento->isEmpty()) {
            return redirect()->route('ordenador.index')
            ->with('error', 'No se puede generar el PDF, el equipo no cuenta con mantenimientos');
        }
        $pdf = Pdf::loadView('ordenador.pdf3', compact('ordenador','mantenimiento'));
        return $pdf->stream();
    }

    public function pdfconinfo($id){

        $mantenimiento = MantenimientoOrdenador::where('ordenador_id', $id)->get();
        $prestamo = Prestamo::where('equipo_id', $id)->get();
        $ordenador = Ordenador::where('id', $id)->get();

        if ($prestamo->isEmpty() || $mantenimiento->isEmpty()) {
            return redirect()->route('ordenador.index')
            ->with('error', 'No se puede generar el PDF, el equipo no cuenta con mantenimientos o préstamos');
        }
        $pdf = Pdf::loadView('ordenador.pdf4', compact('ordenador','mantenimiento','prestamo'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenador = new Ordenador();
        $tipoComputador = TipoComputador::pluck('tipo_computador','id');
        $tipoAdquisicion = TipoAdquisicion::pluck('tipo_adquisicion','id');
        $estadoComputador = EstadoComputador::pluck('estado_computador','id');
        $sistemaOperativo = SistemaOperativo::all();
        $procesador = Procesador::all();
        $slots = SlotsRam::all();
        $modeloRam = TipoRam::pluck('tipoRam','id');
        $tipoDiscoDuro = TipoDiscoDuro::pluck('tipoDiscoDuro','id');
        $localidad = Localidad::all();
        $tipoPantalla = TipoPantalla::pluck('tipoPantalla','id');
        $tipoSoftware = TipoSoftwareComputador::pluck('tipoSoftware','id');
        $tipoAsignacion = TipoAsignacionLocalidad::pluck('tipoAsignacion','id');
        $rolComputador = RolComputador::pluck('rol','id');

        return view('ordenador.create', compact('ordenador','tipoComputador','tipoAdquisicion','estadoComputador','sistemaOperativo','procesador','slots','modeloRam','tipoDiscoDuro','localidad','tipoPantalla','tipoSoftware','tipoAsignacion','rolComputador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ordenador::$rules);

        $ordenador = Ordenador::create($request->all());

        return redirect()->route('ordenador.index')
            ->with('success', 'Ordenador registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordenador = Ordenador::find($id);

        return view('ordenador.show', compact('ordenador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordenador = Ordenador::find($id);
        $tipoComputador = TipoComputador::pluck('tipo_computador','id');
        $tipoAdquisicion = TipoAdquisicion::pluck('tipo_adquisicion','id');
        $estadoComputador = EstadoComputador::pluck('estado_computador','id');
        $sistemaOperativo = SistemaOperativo::all();
        $procesador = Procesador::all();
        $slots = SlotsRam::all();
        $modeloRam = TipoRam::pluck('tipoRam','id');
        $tipoDiscoDuro = TipoDiscoDuro::pluck('tipoDiscoDuro','id');
        $localidad = Localidad::all();
        $tipoPantalla = TipoPantalla::pluck('tipoPantalla','id');
        $tipoSoftware = TipoSoftwareComputador::pluck('tipoSoftware','id');
        $tipoAsignacion = TipoAsignacionLocalidad::pluck('tipoAsignacion','id');
        $rolComputador = RolComputador::pluck('rol','id');

        return view('ordenador.edit', compact('ordenador','tipoComputador','tipoAdquisicion','estadoComputador','sistemaOperativo','procesador','slots','modeloRam','tipoDiscoDuro','localidad','tipoPantalla','tipoSoftware','tipoAsignacion','rolComputador'));
    }
    //Ram
    public function edit2($id)
    {
        $ordenador = Ordenador::find($id);
        $slots = SlotsRam::all();
        $modeloRam = TipoRam::pluck('TipoRam','id');

        return view('ordenador.edit2', compact('ordenador','slots','modeloRam'));
    }
    //Disco Duro
    public function edit3($id)
    {
        $ordenador = Ordenador::find($id);
        $tipodiscoduro = TipoDiscoDuro::pluck('tipoDiscoDuro','id');

        return view('ordenador.edit3', compact('ordenador','tipodiscoduro'));
    }
    //Pantalla
    public function edit4($id)
    {
        $ordenador = Ordenador::find($id);
        $tipoPantalla = TipoPantalla::pluck('tipoPantalla','id');

        return view('ordenador.edit4', compact('ordenador','tipoPantalla'));
    }
    //Sistema Operativo
    public function edit5($id)
    {
        $ordenador = Ordenador::find($id);
        $sistemaOperativo = SistemaOperativo::all();

        return view('ordenador.edit5', compact('ordenador','sistemaOperativo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ordenador $ordenador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordenador $ordenador)
    {

        //request()->validate(Ordenador::$rules);

        $ordenador->update($request->all());

        return redirect()->route('ordenador.index')
            ->with('success', 'Ordenador actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ordenador = Ordenador::find($id)->delete();

        return redirect()->route('ordenador.index')
            ->with('success', 'Ordenador eliminado correctamente');
    }
}
