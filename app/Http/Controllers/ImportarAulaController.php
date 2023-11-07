<?php

namespace App\Http\Controllers;

use App\Imports\ImportarAulas;
use App\Models\ImportarAula;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ImportarAulaController
 * @package App\Http\Controllers
 */
class ImportarAulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importarAulas = ImportarAula::paginate();

        return view('importar-aula.index', compact('importarAulas'))
            ->with('i', (request()->input('page', 1) - 1) * $importarAulas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $importarAula = new ImportarAula();
        return view('importar-aula.create', compact('importarAula'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('import_file_aulas')) {
            return redirect()->route('salon.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {
            $file = $request->file('import_file_aulas');
            $import = new ImportarAulas();
            $import->sheets();
            Excel::import($import, $file);

            return redirect()->route('salon.index')
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
        $importarAula = ImportarAula::find($id);

        return view('importar-aula.show', compact('importarAula'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $importarAula = ImportarAula::find($id);

        return view('importar-aula.edit', compact('importarAula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ImportarAula $importarAula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportarAula $importarAula)
    {
        request()->validate(ImportarAula::$rules);

        $importarAula->update($request->all());

        return redirect()->route('importar-aulas.index')
            ->with('success', 'ImportarAula updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $importarAula = ImportarAula::find($id)->delete();

        return redirect()->route('importar-aulas.index')
            ->with('success', 'ImportarAula deleted successfully');
    }
}