<?php

namespace App\Http\Controllers;

use App\Imports\ImportarPersona;
use App\Models\ImportarexcelPersona;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ImportarexcelPersonaController
 * @package App\Http\Controllers
 */
class ImportarexcelPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importarexcelPersonas = ImportarexcelPersona::paginate();

        return view('importarexcel-persona.index', compact('importarexcelPersonas'))
            ->with('i', (request()->input('page', 1) - 1) * $importarexcelPersonas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $importarexcelPersona = new ImportarexcelPersona();
        return view('importarexcel-persona.create', compact('importarexcelPersona'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('import_file_personas')) {
            return redirect()->route('persona.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {
                
        $file = $request->file('import_file_personas');
        $import = new ImportarPersona();
        $import->sheets();
        Excel::import($import, $file);
    
        return redirect()->route('persona.index')
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
        $importarexcelPersona = ImportarexcelPersona::find($id);

        return view('importarexcel-persona.show', compact('importarexcelPersona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $importarexcelPersona = ImportarexcelPersona::find($id);

        return view('importarexcel-persona.edit', compact('importarexcelPersona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ImportarexcelPersona $importarexcelPersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportarexcelPersona $importarexcelPersona)
    {
        request()->validate(ImportarexcelPersona::$rules);

        $importarexcelPersona->update($request->all());

        return redirect()->route('importarexcel-personas.index')
            ->with('success', 'ImportarexcelPersona updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $importarexcelPersona = ImportarexcelPersona::find($id)->delete();

        return redirect()->route('importarexcel-personas.index')
            ->with('success', 'ImportarexcelPersona deleted successfully');
    }
}
