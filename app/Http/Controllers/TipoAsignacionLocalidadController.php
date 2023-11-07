<?php

namespace App\Http\Controllers;

use App\Models\TipoAsignacionLocalidad;
use Illuminate\Http\Request;

/**
 * Class TipoAsignacionLocalidadController
 * @package App\Http\Controllers
 */
class TipoAsignacionLocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoAsignacionLocalidads = TipoAsignacionLocalidad::paginate();

        return view('tipo-asignacion-localidad.index', compact('tipoAsignacionLocalidads'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoAsignacionLocalidads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoAsignacionLocalidad = new TipoAsignacionLocalidad();
        return view('tipo-asignacion-localidad.create', compact('tipoAsignacionLocalidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoAsignacionLocalidad::$rules);

        $tipoAsignacionLocalidad = TipoAsignacionLocalidad::create($request->all());

        return redirect()->route('tipoAsignacionLocalidad.index')
            ->with('success', 'Asignación de Localidad creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoAsignacionLocalidad = TipoAsignacionLocalidad::find($id);

        return view('tipo-asignacion-localidad.show', compact('tipoAsignacionLocalidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoAsignacionLocalidad = TipoAsignacionLocalidad::find($id);

        return view('tipo-asignacion-localidad.edit', compact('tipoAsignacionLocalidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoAsignacionLocalidad $tipoAsignacionLocalidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAsignacionLocalidad $tipoAsignacionLocalidad)
    {
        request()->validate(TipoAsignacionLocalidad::$rules);

        $tipoAsignacionLocalidad->update($request->all());

        return redirect()->route('tipoAsignacionLocalidad.index')
            ->with('success', 'Asignación de Localidad actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoAsignacionLocalidad = TipoAsignacionLocalidad::find($id)->delete();

        return redirect()->route('tipoAsignacionLocalidad.index')
            ->with('success', 'Asignación de Localidad eliminada correctamente.');
    }
}