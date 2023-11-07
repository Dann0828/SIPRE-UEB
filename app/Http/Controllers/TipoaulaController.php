<?php

namespace App\Http\Controllers;

use App\Models\Tipoaula;
use Illuminate\Http\Request;

/**
 * Class TipoaulaController
 * @package App\Http\Controllers
 */
class TipoaulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoaulas = Tipoaula::paginate();

        return view('tipoaula.index', compact('tipoaulas'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoaulas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoaula = new Tipoaula();
        return view('tipoaula.create', compact('tipoaula'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipoaula::$rules);

        $tipoaula = Tipoaula::create($request->all());

        return redirect()->route('tipoaula.index')
            ->with('success', 'Tipo de Aula agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoaula = Tipoaula::find($id);

        return view('tipoaula.show', compact('tipoaula'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoaula = Tipoaula::find($id);

        return view('tipoaula.edit', compact('tipoaula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipoaula $tipoaula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipoaula $tipoaula)
    {
        request()->validate(Tipoaula::$rules);

        $tipoaula->update($request->all());

        return redirect()->route('tipoaula.index')
            ->with('success', 'Tipo de Aula actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoaula = Tipoaula::find($id)->delete();

        return redirect()->route('tipoaula.index')
            ->with('success', 'Tipo de Aula eliminada correctamente.');
    }
}
