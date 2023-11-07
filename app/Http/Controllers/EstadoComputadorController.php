<?php

namespace App\Http\Controllers;

use App\Models\EstadoComputador;
use Illuminate\Http\Request;

/**
 * Class EstadoComputadorController
 * @package App\Http\Controllers
 */
class EstadoComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadoComputadors = EstadoComputador::paginate();

        return view('estado-computador.index', compact('estadoComputadors'))
            ->with('i', (request()->input('page', 1) - 1) * $estadoComputadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoComputador = new EstadoComputador();
        return view('estado-computador.create', compact('estadoComputador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(EstadoComputador::$rules);

        $estadoComputador = EstadoComputador::create($request->all());

        return redirect()->route('estadoComputador.index')
            ->with('success', 'Estado creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estadoComputador = EstadoComputador::find($id);

        return view('estado-computador.show', compact('estadoComputador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estadoComputador = EstadoComputador::find($id);

        return view('estado-computador.edit', compact('estadoComputador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EstadoComputador $estadoComputador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoComputador $estadoComputador)
    {
        request()->validate(EstadoComputador::$rules);

        $estadoComputador->update($request->all());

        return redirect()->route('estadoComputador.index')
            ->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $estadoComputador = EstadoComputador::find($id)->delete();

        return redirect()->route('estadoComputador.index')
            ->with('success', 'Estado eliminado correctamente.');
    }
}