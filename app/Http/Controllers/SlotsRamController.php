<?php

namespace App\Http\Controllers;

use App\Models\SlotsRam;
use Illuminate\Http\Request;

/**
 * Class SlotsRamController
 * @package App\Http\Controllers
 */
class SlotsRamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slotsRams = SlotsRam::paginate();

        return view('slots-ram.index', compact('slotsRams'))
            ->with('i', (request()->input('page', 1) - 1) * $slotsRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slotsRam = new SlotsRam();
        return view('slots-ram.create', compact('slotsRam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SlotsRam::$rules);

        $slotsRam = SlotsRam::create($request->all());

        return redirect()->route('slotsRam.index')
            ->with('success', 'SlotsRam created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slotsRam = SlotsRam::find($id);

        return view('slots-ram.show', compact('slotsRam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slotsRam = SlotsRam::find($id);

        return view('slots-ram.edit', compact('slotsRam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SlotsRam $slotsRam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlotsRam $slotsRam)
    {
        request()->validate(SlotsRam::$rules);

        $slotsRam->update($request->all());

        return redirect()->route('slotsRam.index')
            ->with('success', 'SlotsRam updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $slotsRam = SlotsRam::find($id)->delete();

        return redirect()->route('slotsRam.index')
            ->with('success', 'SlotsRam deleted successfully');
    }
}