<?php

namespace App\Http\Controllers;

use App\Models\SalonOrdenador;
use Illuminate\Http\Request;

/**
 * Class SalonOrdenadorController
 * @package App\Http\Controllers
 */
class SalonOrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salonOrdenadors = SalonOrdenador::paginate();

        return view('salon-ordenador.index', compact('salonOrdenadors'))
            ->with('i', (request()->input('page', 1) - 1) * $salonOrdenadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salonOrdenador = new SalonOrdenador();
        return view('salon-ordenador.create', compact('salonOrdenador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SalonOrdenador::$rules);

        $salonOrdenador = SalonOrdenador::create($request->all());

        return redirect()->route('salon-ordenadors.index')
            ->with('success', 'SalonOrdenador created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salonOrdenador = SalonOrdenador::find($id);

        return view('salon-ordenador.show', compact('salonOrdenador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salonOrdenador = SalonOrdenador::find($id);

        return view('salon-ordenador.edit', compact('salonOrdenador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SalonOrdenador $salonOrdenador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalonOrdenador $salonOrdenador)
    {
        request()->validate(SalonOrdenador::$rules);

        $salonOrdenador->update($request->all());

        return redirect()->route('salon-ordenadors.index')
            ->with('success', 'SalonOrdenador updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonOrdenador = SalonOrdenador::find($id)->delete();

        return redirect()->route('salon-ordenadors.index')
            ->with('success', 'SalonOrdenador deleted successfully');
    }
}
