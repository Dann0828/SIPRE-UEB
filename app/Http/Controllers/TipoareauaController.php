<?php

namespace App\Http\Controllers;

use App\Models\Tipoareaua;
use Illuminate\Http\Request;

/**
 * Class TipoareauaController
 * @package App\Http\Controllers
 */
class TipoareauaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoareauas = Tipoareaua::paginate();

        return view('tipoareaua.index', compact('tipoareauas'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoareauas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoareaua = new Tipoareaua();
        return view('tipoareaua.create', compact('tipoareaua'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipoareaua::$rules);

        $tipoareaua = Tipoareaua::create($request->all());

        return redirect()->route('tipoareauas.index')
            ->with('success', 'Tipoareaua created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoareaua = Tipoareaua::find($id);

        return view('tipoareaua.show', compact('tipoareaua'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoareaua = Tipoareaua::find($id);

        return view('tipoareaua.edit', compact('tipoareaua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipoareaua $tipoareaua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipoareaua $tipoareaua)
    {
        request()->validate(Tipoareaua::$rules);

        $tipoareaua->update($request->all());

        return redirect()->route('tipoareauas.index')
            ->with('success', 'Tipoareaua updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoareaua = Tipoareaua::find($id)->delete();

        return redirect()->route('tipoareauas.index')
            ->with('success', 'Tipoareaua deleted successfully');
    }
}
