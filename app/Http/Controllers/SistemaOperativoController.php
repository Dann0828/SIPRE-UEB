<?php

namespace App\Http\Controllers;

use App\Models\SistemaOperativo;
use Illuminate\Http\Request;

/**
 * Class SistemaOperativoController
 * @package App\Http\Controllers
 */
class SistemaOperativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistemaOperativos = SistemaOperativo::paginate();

        return view('sistema-operativo.index', compact('sistemaOperativos'))
            ->with('i', (request()->input('page', 1) - 1) * $sistemaOperativos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sistemaOperativo = new SistemaOperativo();
        return view('sistema-operativo.create', compact('sistemaOperativo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SistemaOperativo::$rules);

        $sistemaOperativo = SistemaOperativo::create($request->all());

        return redirect()->route('sistemaOperativo.index')
            ->with('success', 'Sistema Operativo creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sistemaOperativo = SistemaOperativo::find($id);

        return view('sistema-operativo.show', compact('sistemaOperativo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sistemaOperativo = SistemaOperativo::find($id);

        return view('sistema-operativo.edit', compact('sistemaOperativo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SistemaOperativo $sistemaOperativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SistemaOperativo $sistemaOperativo)
    {
        request()->validate(SistemaOperativo::$rules);

        $sistemaOperativo->update($request->all());

        return redirect()->route('sistemaOperativo.index')
            ->with('success', 'Sistema Operativo actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sistemaOperativo = SistemaOperativo::find($id)->delete();

        return redirect()->route('sistemaOperativo.index')
            ->with('success', 'Sistema Operativo eliminado correcatamente.');
    }
}