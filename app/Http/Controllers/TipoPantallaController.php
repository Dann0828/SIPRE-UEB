<?php

namespace App\Http\Controllers;

use App\Models\TipoPantalla;
use Illuminate\Http\Request;

/**
 * Class TipoPantallaController
 * @package App\Http\Controllers
 */
class TipoPantallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoPantallas = TipoPantalla::paginate();

        return view('tipo-pantalla.index', compact('tipoPantallas'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoPantallas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoPantalla = new TipoPantalla();
        return view('tipo-pantalla.create', compact('tipoPantalla'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoPantalla::$rules);

        $tipoPantalla = TipoPantalla::create($request->all());

        return redirect()->route('tipoPantalla.index')
            ->with('success', 'Tipo de Pantalla creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoPantalla = TipoPantalla::find($id);

        return view('tipo-pantalla.show', compact('tipoPantalla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoPantalla = TipoPantalla::find($id);

        return view('tipo-pantalla.edit', compact('tipoPantalla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoPantalla $tipoPantalla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPantalla $tipoPantalla)
    {
        request()->validate(TipoPantalla::$rules);

        $tipoPantalla->update($request->all());

        return redirect()->route('tipoPantalla.index')
            ->with('success', 'Tipo de Pantalla actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoPantalla = TipoPantalla::find($id)->delete();

        return redirect()->route('tipoPantalla.index')
            ->with('success', 'Tipo de Pantalla eliminado correctamente.');
    }
}