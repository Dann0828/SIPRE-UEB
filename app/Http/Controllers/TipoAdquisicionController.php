<?php

namespace App\Http\Controllers;

use App\Models\TipoAdquisicion;
use Illuminate\Http\Request;

/**
 * Class TipoAdquisicionController
 * @package App\Http\Controllers
 */
class TipoAdquisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoAdquisicions = TipoAdquisicion::paginate();

        return view('tipo-adquisicion.index', compact('tipoAdquisicions'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoAdquisicions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoAdquisicion = new TipoAdquisicion();
        return view('tipo-adquisicion.create', compact('tipoAdquisicion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoAdquisicion::$rules);

        $tipoAdquisicion = TipoAdquisicion::create($request->all());

        return redirect()->route('tipoAdquisicion.index')
            ->with('success', 'Tipo de Adquisición creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoAdquisicion = TipoAdquisicion::find($id);

        return view('tipo-adquisicion.show', compact('tipoAdquisicion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoAdquisicion = TipoAdquisicion::find($id);

        return view('tipo-adquisicion.edit', compact('tipoAdquisicion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoAdquisicion $tipoAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAdquisicion $tipoAdquisicion)
    {
        request()->validate(TipoAdquisicion::$rules);

        $tipoAdquisicion->update($request->all());

        return redirect()->route('tipoAdquisicion.index')
            ->with('success', 'Tipo de Adquisición actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoAdquisicion = TipoAdquisicion::find($id)->delete();

        return redirect()->route('tipoAdquisicion.index')
            ->with('success', 'Tipo de Adquisición eliminado correctamente.');
    }
}