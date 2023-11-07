<?php

namespace App\Http\Controllers;

use App\Models\TipoComputador;
use Illuminate\Http\Request;

/**
 * Class TipoComputadorController
 * @package App\Http\Controllers
 */
class TipoComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoComputadors = TipoComputador::paginate();

        return view('tipo-computador.index', compact('tipoComputadors'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoComputadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoComputador = new TipoComputador();
        return view('tipo-computador.create', compact('tipoComputador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoComputador::$rules);

        $tipoComputador = TipoComputador::create($request->all());

        return redirect()->route('tipoComputador.index')
            ->with('success', 'Tipo de Ordenador creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoComputador = TipoComputador::find($id);

        return view('tipo-computador.show', compact('tipoComputador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoComputador = TipoComputador::find($id);

        return view('tipo-computador.edit', compact('tipoComputador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoComputador $tipoComputador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoComputador $tipoComputador)
    {
        request()->validate(TipoComputador::$rules);

        $tipoComputador->update($request->all());

        return redirect()->route('tipoComputador.index')
            ->with('success', 'Tipo de Ordenador actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoComputador = TipoComputador::find($id)->delete();

        return redirect()->route('tipoComputador.index')
            ->with('success', 'Tipo de Ordenador eliminado correctamente.');
    }
}
