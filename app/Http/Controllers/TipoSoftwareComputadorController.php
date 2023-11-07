<?php

namespace App\Http\Controllers;

use App\Models\TipoSoftwareComputador;
use Illuminate\Http\Request;

/**
 * Class TipoSoftwareComputadorController
 * @package App\Http\Controllers
 */
class TipoSoftwareComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoSoftwareComputadors = TipoSoftwareComputador::paginate();

        return view('tipo-software-computador.index', compact('tipoSoftwareComputadors'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoSoftwareComputadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoSoftwareComputador = new TipoSoftwareComputador();
        return view('tipo-software-computador.create', compact('tipoSoftwareComputador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoSoftwareComputador::$rules);

        $tipoSoftwareComputador = TipoSoftwareComputador::create($request->all());

        return redirect()->route('tipoSoftwareComputador.index')
            ->with('success', 'Tipo de Software creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoSoftwareComputador = TipoSoftwareComputador::find($id);

        return view('tipo-software-computador.show', compact('tipoSoftwareComputador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoSoftwareComputador = TipoSoftwareComputador::find($id);

        return view('tipo-software-computador.edit', compact('tipoSoftwareComputador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoSoftwareComputador $tipoSoftwareComputador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoSoftwareComputador $tipoSoftwareComputador)
    {
        request()->validate(TipoSoftwareComputador::$rules);

        $tipoSoftwareComputador->update($request->all());

        return redirect()->route('tipoSoftwareComputador.index')
            ->with('success', 'Tipo de Software actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoSoftwareComputador = TipoSoftwareComputador::find($id)->delete();

        return redirect()->route('tipoSoftwareComputador.index')
            ->with('success', 'Tipo de Software eliminado correctamente.');
    }
}