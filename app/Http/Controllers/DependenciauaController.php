<?php

namespace App\Http\Controllers;

use App\Models\Dependenciaua;
use App\Models\Tipoareaua;
use Illuminate\Http\Request;

/**
 * Class DependenciauaController
 * @package App\Http\Controllers
 */
class DependenciauaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependenciauas = Dependenciaua::paginate();
        return view('dependenciaua.index', compact('dependenciauas'))
            ->with('i', (request()->input('page', 1) - 1) * $dependenciauas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dependenciaua = new Dependenciaua();
        $area = Tipoareaua::pluck('descripcion','id');
        return view('dependenciaua.create', compact('dependenciaua','area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Dependenciaua::$rules);

        $dependenciaua = Dependenciaua::create($request->all());

        return redirect()->route('dependenciauas.index')
            ->with('success', 'Dependencia creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependenciaua = Dependenciaua::find($id);

        return view('dependenciaua.show', compact('dependenciaua'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependenciaua = Dependenciaua::find($id);
        $area = Tipoareaua::pluck('descripcion','id');
        return view('dependenciaua.edit', compact('dependenciaua','area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Dependenciaua $dependenciaua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependenciaua $dependenciaua)
    {
        request()->validate(Dependenciaua::$rules);

        $dependenciaua->update($request->all());

        return redirect()->route('dependenciauas.index')
            ->with('success', 'Dependencia actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dependenciaua = Dependenciaua::find($id)->delete();

        return redirect()->route('dependenciauas.index')
            ->with('success', 'Dependencia eliminada correctamente.');
    }
}
