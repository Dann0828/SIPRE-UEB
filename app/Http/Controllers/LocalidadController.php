<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

/**
 * Class LocalidadController
 * @package App\Http\Controllers
 */
class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidads = Localidad::paginate();

        return view('localidad.index', compact('localidads'))
            ->with('i', (request()->input('page', 1) - 1) * $localidads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localidad = new Localidad();
        return view('localidad.create', compact('localidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Localidad::$rules);

        $localidad = Localidad::create($request->all());

        return redirect()->route('localidad.index')
            ->with('success', 'Localidad creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $localidad = Localidad::find($id);

        return view('localidad.show', compact('localidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localidad = Localidad::find($id);

        return view('localidad.edit', compact('localidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Localidad $localidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localidad $localidad)
    {
        request()->validate(Localidad::$rules);

        $localidad->update($request->all());

        return redirect()->route('localidad.index')
            ->with('success', 'Localidad actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $localidad = Localidad::find($id)->delete();

        return redirect()->route('localidad.index')
            ->with('success', 'Localidad eliminada correctamente.');
    }
}