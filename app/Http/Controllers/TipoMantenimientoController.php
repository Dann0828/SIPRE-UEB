<?php

namespace App\Http\Controllers;

use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;


/**
 * Class TipomantenimientoController
 * @package App\Http\Controllers
 */
class TipomantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipomantenimientos = TipoMantenimiento::paginate();

        return view('tipomantenimiento.index', compact('tipomantenimientos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipomantenimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipomantenimiento = new TipoMantenimiento();
        return view('tipomantenimiento.create', compact('tipomantenimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoMantenimiento::$rules);

        $tipomantenimiento = TipoMantenimiento::create($request->all());

        return redirect()->route('tipomantenimiento.index')
            ->with('success', 'Tipo de Mantenimiento creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipomantenimiento = TipoMantenimiento::find($id);

        return view('tipomantenimiento.show', compact('tipomantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipomantenimiento = TipoMantenimiento::find($id);

        return view('tipomantenimiento.edit', compact('tipomantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipomantenimiento $tipomantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMantenimiento $tipomantenimiento)
    {
        request()->validate(TipoMantenimiento::$rules);

        $tipomantenimiento->update($request->all());

        return redirect()->route('tipomantenimiento.index')
            ->with('success', 'Tipo de Mantenimiento actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipomantenimiento = TipoMantenimiento::find($id)->delete();

        return redirect()->route('tipomantenimiento.index')
            ->with('success', 'Tipo de Mantenimiento eliminado correctamente.');
    }
}
