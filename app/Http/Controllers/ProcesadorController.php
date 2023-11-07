<?php

namespace App\Http\Controllers;

use App\Models\Procesador;
use Illuminate\Http\Request;

/**
 * Class ProcesadorController
 * @package App\Http\Controllers
 */
class ProcesadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procesadors = Procesador::paginate();

        return view('procesador.index', compact('procesadors'))
            ->with('i', (request()->input('page', 1) - 1) * $procesadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $procesador = new Procesador();
        return view('procesador.create', compact('procesador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Procesador::$rules);

        $procesador = Procesador::create($request->all());

        return redirect()->route('procesador.index')
            ->with('success', 'Procesador creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $procesador = Procesador::find($id);

        return view('procesador.show', compact('procesador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procesador = Procesador::find($id);

        return view('procesador.edit', compact('procesador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Procesador $procesador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procesador $procesador)
    {
        request()->validate(Procesador::$rules);

        $procesador->update($request->all());

        return redirect()->route('procesador.index')
            ->with('success', 'Procesador actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $procesador = Procesador::find($id)->delete();

        return redirect()->route('procesador.index')
            ->with('success', 'Procesador eliminado correctamente.');
    }
}