<?php

namespace App\Http\Controllers;

use App\Models\TipoRam;
use Illuminate\Http\Request;

/**
 * Class TipoRamController
 * @package App\Http\Controllers
 */
class TipoRamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoRams = TipoRam::paginate();

        return view('tipo-ram.index', compact('tipoRams'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoRam = new TipoRam();
        return view('tipo-ram.create', compact('tipoRam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoRam::$rules);

        $tipoRam = TipoRam::create($request->all());

        return redirect()->route('tipoRam.index')
            ->with('success', 'Tipo de Memoria RAM creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoRam = TipoRam::find($id);

        return view('tipo-ram.show', compact('tipoRam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoRam = TipoRam::find($id);

        return view('tipo-ram.edit', compact('tipoRam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoRam $tipoRam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoRam $tipoRam)
    {
        request()->validate(TipoRam::$rules);

        $tipoRam->update($request->all());

        return redirect()->route('tipoRam.index')
            ->with('success', 'Tipo de Memoria RAM actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoRam = TipoRam::find($id)->delete();

        return redirect()->route('tipoRam.index')
            ->with('success', 'Tipo de Memoria RAM eliminado correctamente.');
    }
}