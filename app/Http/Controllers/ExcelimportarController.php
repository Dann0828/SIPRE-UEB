<?php

namespace App\Http\Controllers;

use App\Imports\ImportarComputador;
use App\Imports\OrdenadorSalon;
use App\Models\Excelimportar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ExcelimportarController
 * @package App\Http\Controllers
 */
class ExcelimportarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excelimportars = Excelimportar::paginate();

        return view('excelimportar.index', compact('excelimportars'))
            ->with('i', (request()->input('page', 1) - 1) * $excelimportars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarSalones(Request $request)
    {
        if (!$request->hasFile('import_file_salonOrdenador')) {
            return redirect()->route('mantenimientoordenador.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {

            $file = $request->file('import_file_salonOrdenador');
            
            $import = new OrdenadorSalon();
            Excel::import($import, $file);

            return redirect()->route('mantenimientoordenador.index')
                ->with('success', 'Importación completada con éxito.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('import_file')) {
            return redirect()->route('ordenador.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {

            $file = $request->file('import_file');

            $import = new ImportarComputador();
            $import->sheets();
            Excel::import($import, $file);

            return redirect()->route('ordenador.index')
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
        $excelimportar = Excelimportar::find($id);

        return view('excelimportar.show', compact('excelimportar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $excelimportar = Excelimportar::find($id);

        return view('excelimportar.edit', compact('excelimportar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Excelimportar $excelimportar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Excelimportar $excelimportar)
    {
        request()->validate(Excelimportar::$rules);

        $excelimportar->update($request->all());

        return redirect()->route('excelimportars.index')
            ->with('success', 'Excelimportar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $excelimportar = Excelimportar::find($id)->delete();

        return redirect()->route('excelimportars.index')
            ->with('success', 'Excelimportar deleted successfully');
    }
}
