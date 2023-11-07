<?php

namespace App\Http\Controllers;

use App\Models\TipoCambio;
use Illuminate\Http\Request;

/**
 * Class TipocambioController
 * @package App\Http\Controllers
 */
class TipocambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipocambios = TipoCambio::paginate();

        return view('tipocambio.index', compact('tipocambios'))
            ->with('i', (request()->input('page', 1) - 1) * $tipocambios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipocambio = new TipoCambio();
        return view('tipocambio.create', compact('tipocambio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoCambio::$rules);

        $tipocambio = TipoCambio::create($request->all());

        return redirect()->route('tipocambio.index')
            ->with('success', 'Tipo de Cambio creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipocambio = TipoCambio::find($id);

        return view('tipocambio.show', compact('tipocambio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipocambio = TipoCambio::find($id);

        return view('tipocambio.edit', compact('tipocambio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipocambio $tipocambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipocambio $tipocambio)
    {
        request()->validate(TipoCambio::$rules);

        $tipocambio->update($request->all());

        return redirect()->route('tipocambio.index')
            ->with('success', 'Tipo de Cambio actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipocambio = TipoCambio::find($id)->delete();

        return redirect()->route('tipocambio.index')
            ->with('success', 'Tipo de Cambio eliminado correctamente.');
    }
}
