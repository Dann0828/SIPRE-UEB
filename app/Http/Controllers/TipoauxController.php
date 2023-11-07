<?php

namespace App\Http\Controllers;

use App\Models\Tipoaux;
use Illuminate\Http\Request;

/**
 * Class TipoauxController
 * @package App\Http\Controllers
 */
class TipoauxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoauxes = Tipoaux::paginate();

        return view('tipoaux.index', compact('tipoauxes'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoauxes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoaux = new Tipoaux();
        return view('tipoaux.create', compact('tipoaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipoaux::$rules);

        $tipoaux = Tipoaux::create($request->all());

        return redirect()->route('tipoaux.index')
            ->with('success', 'Tipo de Periférico o Auxiliar creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoaux = Tipoaux::find($id);

        return view('tipoaux.show', compact('tipoaux'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoaux = Tipoaux::find($id);

        return view('tipoaux.edit', compact('tipoaux'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipoaux $tipoaux
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipoaux $tipoaux)
    {
        request()->validate(Tipoaux::$rules);

        $tipoaux->update($request->all());

        return redirect()->route('tipoaux.index')
            ->with('success', 'Tipo de Periférico o Auxiliar actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoaux = Tipoaux::find($id)->delete();

        return redirect()->route('tipoaux.index')
            ->with('success', 'Tipo de Periférico o Auxiliar eliminado correctamente.');
    }
}
