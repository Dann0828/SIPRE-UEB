<?php

namespace App\Http\Controllers;

use App\Models\RolComputador;
use Illuminate\Http\Request;

/**
 * Class RolComputadorController
 * @package App\Http\Controllers
 */
class RolComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolComputadors = RolComputador::paginate();

        return view('rol-computador.index', compact('rolComputadors'))
            ->with('i', (request()->input('page', 1) - 1) * $rolComputadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rolComputador = new RolComputador();
        return view('rol-computador.create', compact('rolComputador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RolComputador::$rules);

        $rolComputador = RolComputador::create($request->all());

        return redirect()->route('rolComputador.index')
            ->with('success', 'Rol creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rolComputador = RolComputador::find($id);

        return view('rol-computador.show', compact('rolComputador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolComputador = RolComputador::find($id);

        return view('rol-computador.edit', compact('rolComputador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RolComputador $rolComputador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolComputador $rolComputador)
    {
        request()->validate(RolComputador::$rules);

        $rolComputador->update($request->all());

        return redirect()->route('rolComputador.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rolComputador = RolComputador::find($id)->delete();

        return redirect()->route('rolComputador.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}