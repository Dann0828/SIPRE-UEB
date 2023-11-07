<?php

namespace App\Http\Controllers;

use App\Models\Excelua;
use App\Imports\ImportarUA;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ExceluaController
 * @package App\Http\Controllers
 */
class ExceluaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exceluas = Excelua::paginate();

        return view('excelua.index', compact('exceluas'))
            ->with('i', (request()->input('page', 1) - 1) * $exceluas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $excelua = new Excelua();
        return view('excelua.create', compact('excelua'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('import_file_UA')) {
            return redirect()->route('dependenciaua.index')
                ->with('error', 'Por favor, selecciona un archivo antes de intentar importar.');
        } else {

            $file = $request->file('import_file_UA');

            $import = new ImportarUA();
            $import->sheets();
            Excel::import($import, $file);

            return redirect()->route('dependenciaua.index')
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
        $excelua = Excelua::find($id);

        return view('excelua.show', compact('excelua'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $excelua = Excelua::find($id);

        return view('excelua.edit', compact('excelua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Excelua $excelua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Excelua $excelua)
    {
        request()->validate(Excelua::$rules);

        $excelua->update($request->all());

        return redirect()->route('exceluas.index')
            ->with('success', 'Excelua updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $excelua = Excelua::find($id)->delete();

        return redirect()->route('exceluas.index')
            ->with('success', 'Excelua deleted successfully');
    }
}
