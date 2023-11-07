<?php

namespace App\Http\Controllers;

use App\Models\Perifericosyauxiliare;
use App\Models\Localidad;
use App\Models\EstadoComputador;
use App\Models\Mantenimientoperiferico;
use App\Models\Prestamop;
use App\Models\Tipoaux;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class PerifericosyauxiliareController
 * @package App\Http\Controllers
 */
class PerifericosyauxiliareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perifericosyauxiliares = Perifericosyauxiliare::paginate();

        return view('perifericosyauxiliare.index', compact('perifericosyauxiliares'))
            ->with('i', (request()->input('page', 1) - 1) * $perifericosyauxiliares->perPage());
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Perifericosyauxiliare::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $perifericosyauxiliares = $query->paginate();
        $perifericosyauxiliares->appends(['busqueda' => $busqueda]);
        return view('perifericosyauxiliare.index', compact('perifericosyauxiliares'));
    }


    public function pdfsininfo($id){

        $equipo = Perifericosyauxiliare::where('id', $id)->get();

        if ($equipo->isEmpty()) {
            return redirect()->route('perifericosyauxiliares.index')
            ->with('error', 'No se puede generar el PDF');
        }
        $pdf = Pdf::loadView('perifericosyauxiliare.pdf1', compact('equipo'));
        return $pdf->stream();
    }

    public function pdfprestamo($id){

        $prestamo = Prestamop::where('perifericosyauxiliares_id', $id)->get();
        $equipo = Perifericosyauxiliare::where('id', $id)->get();

        if ($prestamo->isEmpty()) {
            return redirect()->route('perifericosyauxiliares.index')
            ->with('error', 'No se puede generar el PDF, el equipo no cuenta con préstamos');
        }
        $pdf = Pdf::loadView('perifericosyauxiliare.pdf2', compact('equipo','prestamo'));
        return $pdf->stream();
    }

    public function pdfmantenimiento($id){

        $mantenimiento = Mantenimientoperiferico::where('perifericos_id', $id)->get();
        $equipo = Perifericosyauxiliare::where('id', $id)->get();

        if ($mantenimiento->isEmpty()) {
            return redirect()->route('perifericosyauxiliares.index')
            ->with('error', 'No se puede generar el PDF, el equipo no cuenta con mantenimientos');
        }
        $pdf = Pdf::loadView('perifericosyauxiliare.pdf3', compact('equipo','mantenimiento'));
        return $pdf->stream();
    }

    public function pdfconinfo($id){

        $mantenimiento = Mantenimientoperiferico::where('perifericos_id', $id)->get();
        $equipo = Perifericosyauxiliare::where('id', $id)->get();
        $prestamo = Prestamop::where('perifericosyauxiliares_id', $id)->get();

        if ($prestamo->isEmpty() || $mantenimiento->isEmpty()) {
            return redirect()->route('perifericosyauxiliares.index')
            ->with('error', 'No se puede generar el PDF, el equipo no cuenta con mantenimientos o préstamos');
        }
        $pdf = Pdf::loadView('perifericosyauxiliare.pdf4', compact('equipo','mantenimiento','prestamo'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perifericosyauxiliare = new Perifericosyauxiliare();
        $tipoaux = Tipoaux::pluck('tipo_aux','id');
        $localidad = Localidad::all();
        $estadoComputador = EstadoComputador::pluck('estado_computador','id');
        return view('perifericosyauxiliare.create', compact('perifericosyauxiliare','tipoaux','localidad','estadoComputador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Perifericosyauxiliare::$rules);

        $perifericosyauxiliare = Perifericosyauxiliare::create($request->all());

        return redirect()->route('perifericosyauxiliares.index')
            ->with('success', 'Periféricos y Auxiliares registrados exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perifericosyauxiliare = Perifericosyauxiliare::find($id);

        return view('perifericosyauxiliare.show', compact('perifericosyauxiliare'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perifericosyauxiliare = Perifericosyauxiliare::find($id);
        $tipoaux = Tipoaux::pluck('tipo_aux','id');
        $localidad = Localidad::all();
        $estadoComputador = EstadoComputador::pluck('estado_computador','id');
        return view('perifericosyauxiliare.edit', compact('perifericosyauxiliare','tipoaux','localidad','estadoComputador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Perifericosyauxiliare $perifericosyauxiliare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perifericosyauxiliare $perifericosyauxiliare)
    {
        //request()->validate(Perifericosyauxiliare::$rules);

        $perifericosyauxiliare->update($request->all());

        return redirect()->route('perifericosyauxiliares.index')
            ->with('success', 'Información actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $perifericosyauxiliare = Perifericosyauxiliare::find($id)->delete();

        return redirect()->route('perifericosyauxiliares.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}
