<?php

namespace App\Http\Controllers;

use App\Imports\ImportarperifericosAuxiliares;
use App\Models\Importarexcelpa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ImportarexcelpaController
 * @package App\Http\Controllers
 */
class ImportarexcelpaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importarexcelpas = Importarexcelpa::paginate();

        return view('importarexcelpa.index', compact('importarexcelpas'))
            ->with('i', (request()->input('page', 1) - 1) * $importarexcelpas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $importarexcelpa = new Importarexcelpa();
        return view('importarexcelpa.create', compact('importarexcelpa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('import_filepa')) {
            return redirect()->route('perifericosyauxiliares.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {

            $file = $request->file('import_filepa');
            $import = new ImportarperifericosAuxiliares();
            $import->sheets();
            Excel::import($import, $file);

            return redirect()->route('perifericosyauxiliares.index')
                ->with('success', 'Importación completada con éxito.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $importarexcelpa = Importarexcelpa::find($id);

        return view('importarexcelpa.show', compact('importarexcelpa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $importarexcelpa = Importarexcelpa::find($id);

        return view('importarexcelpa.edit', compact('importarexcelpa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Importarexcelpa $importarexcelpa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Importarexcelpa $importarexcelpa)
    {
        request()->validate(Importarexcelpa::$rules);

        $importarexcelpa->update($request->all());

        return redirect()->route('importarexcelpas.index')
            ->with('success', 'Importarexcelpa updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $importarexcelpa = Importarexcelpa::find($id)->delete();

        return redirect()->route('importarexcelpas.index')
            ->with('success', 'Importarexcelpa deleted successfully');
    }
}