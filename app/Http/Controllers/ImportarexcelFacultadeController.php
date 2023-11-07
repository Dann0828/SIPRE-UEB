<?php

namespace App\Http\Controllers;
use App\Imports\ImportarProgramas;
use App\Models\ImportarexcelFacultade;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ImportarexcelFacultadeController
 * @package App\Http\Controllers
 */
class ImportarexcelFacultadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importarexcelFacultades = ImportarexcelFacultade::paginate();

        return view('importarexcel-facultade.index', compact('importarexcelFacultades'))
            ->with('i', (request()->input('page', 1) - 1) * $importarexcelFacultades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $importarexcelFacultade = new ImportarexcelFacultade();
        return view('importarexcel-facultade.create', compact('importarexcelFacultade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('import_file_facultades')) {
            return redirect()->route('programa.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {

            $file = $request->file('import_file_facultades');

            $import = new ImportarProgramas();
            $import->sheets();
            Excel::import($import, $file);

            return redirect()->route('programa.index')
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
        $importarexcelFacultade = ImportarexcelFacultade::find($id);

        return view('importarexcel-facultade.show', compact('importarexcelFacultade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $importarexcelFacultade = ImportarexcelFacultade::find($id);

        return view('importarexcel-facultade.edit', compact('importarexcelFacultade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ImportarexcelFacultade $importarexcelFacultade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportarexcelFacultade $importarexcelFacultade)
    {
        request()->validate(ImportarexcelFacultade::$rules);

        $importarexcelFacultade->update($request->all());

        return redirect()->route('importarexcel-facultades.index')
            ->with('success', 'ImportarexcelFacultade updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $importarexcelFacultade = ImportarexcelFacultade::find($id)->delete();

        return redirect()->route('importarexcel-facultades.index')
            ->with('success', 'ImportarexcelFacultade deleted successfully');
    }
}