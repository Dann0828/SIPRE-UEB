<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\Salon;
use App\Models\Tipoaula;
use Illuminate\Http\Request;

/**
 * Class SalonController
 * @package App\Http\Controllers
 */
class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salons = Salon::paginate();

        return view('salon.index', compact('salons'))
            ->with('i', (request()->input('page', 1) - 1) * $salons->perPage());
    }

    public function buscarPorId(Request $request){

        $busqueda = $request->input('busqueda');

        $query = Salon::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                $query->where('descripcion', 'LIKE', '%' . $busqueda . '%');
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $salons = $query->paginate();
        $salons->appends(['busqueda' => $busqueda]);
        return view('salon.index', compact('salons'))
            ->with('i', ($salons->currentPage() - 1) * $salons->perPage());

    }

    public function buscarPorEdificio(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Salon::query()
            ->leftJoin('edificio', 'salon.edificio_id', '=', 'edificio.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('edificio.id', '=', $busqueda);
                    } else {
                        $query->orWhere('edificio.descripcion', '=', $busqueda);
                    }
                });
        }

        $salons = $query->select([
            'salon.*',
            'edificio.descripcion AS edificio_descripcion',
        ])->paginate();
        $salons->appends(['busqueda' => $busqueda]);
        return view('salon.index', compact('salons'))
            ->with('i', ($salons->currentPage() - 1) * $salons->perPage());
    }

    public function buscarPorTipoAula(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Salon::query()
            ->leftJoin('tipoaula', 'salon.tipoaula_id', '=', 'tipoaula.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('tipoaula.id', '=', $busqueda);
                    } else {
                        $query->orWhere('tipoaula.descripcion', '=', $busqueda);
                    }
                });
        }

        $salons = $query->select([
            'salon.*',
            'tipoaula.descripcion AS tipoaula_descripcion',
        ])->paginate();
        $salons->appends(['busqueda' => $busqueda]);
        return view('salon.index', compact('salons'))
            ->with('i', ($salons->currentPage() - 1) * $salons->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salon = new Salon();
        $edificio = Edificio::pluck('descripcion','id');
        $tipoaula = Tipoaula::pluck('descripcion','id');
        return view('salon.create', compact('salon','edificio','tipoaula'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Salon::$rules);

        $salon = Salon::create($request->all());

        return redirect()->route('salon.index')
            ->with('success', 'Aula registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salon = Salon::find($id);

        return view('salon.show', compact('salon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salon = Salon::find($id);

        return view('salon.edit', compact('salon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Salon $salon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salon $salon)
    {
        request()->validate(Salon::$rules);

        $salon->update($request->all());

        return redirect()->route('salon.index')
            ->with('success', 'Aula actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salon = Salon::find($id)->delete();

        return redirect()->route('salon.index')
            ->with('success', 'Aula eliminada correctamente.');
    }
}
