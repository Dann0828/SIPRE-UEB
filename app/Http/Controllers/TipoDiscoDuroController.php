<?php

namespace App\Http\Controllers;

use App\Models\TipoDiscoDuro;
use Illuminate\Http\Request;

/**
 * Class TipoDiscoDuroController
 * @package App\Http\Controllers
 */
class TipoDiscoDuroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoDiscoDuros = TipoDiscoDuro::paginate();

        return view('tipo-disco-duro.index', compact('tipoDiscoDuros'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoDiscoDuros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoDiscoDuro = new TipoDiscoDuro();
        return view('tipo-disco-duro.create', compact('tipoDiscoDuro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoDiscoDuro::$rules);

        $tipoDiscoDuro = TipoDiscoDuro::create($request->all());

        return redirect()->route('tipoDiscoDuro.index')
            ->with('success', 'Tipo de Disco Duro creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoDiscoDuro = TipoDiscoDuro::find($id);

        return view('tipo-disco-duro.show', compact('tipoDiscoDuro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoDiscoDuro = TipoDiscoDuro::find($id);

        return view('tipo-disco-duro.edit', compact('tipoDiscoDuro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoDiscoDuro $tipoDiscoDuro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDiscoDuro $tipoDiscoDuro)
    {
        request()->validate(TipoDiscoDuro::$rules);

        $tipoDiscoDuro->update($request->all());

        return redirect()->route('tipoDiscoDuro.index')
            ->with('success', 'Tipo de Disco Duro actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoDiscoDuro = TipoDiscoDuro::find($id)->delete();

        return redirect()->route('tipoDiscoDuro.index')
            ->with('success', 'Tipo de Disco Duro eliminado correctamente.');
    }
}