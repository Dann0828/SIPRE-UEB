<?php

namespace App\Http\Controllers;

use App\Models\Hojavidaperiferico;
use App\Models\Mantenimientoperiferico;
use App\Models\Perifericosyauxiliare;
use App\Models\TipoMantenimiento;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class MantenimientoperifericoController
 * @package App\Http\Controllers
 */
class MantenimientoperifericoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimientoperifericos = Mantenimientoperiferico::orderBy('mantenimientoperiferico.created_at', 'desc')->paginate();

        return view('mantenimientoperiferico.index', compact('mantenimientoperifericos'))
            ->with('i', ($mantenimientoperifericos->currentPage() - 1) * $mantenimientoperifericos->perPage());
    }

    public function buscarPorId(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Mantenimientoperiferico::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $mantenimientoperifericos = $query->orderBy('mantenimientoperiferico.created_at', 'desc')->paginate();
        $mantenimientoperifericos->appends(['busqueda' => $busqueda]);
        return view('mantenimientoperiferico.index', compact('mantenimientoperifericos'))
            ->with('i', ($mantenimientoperifericos->currentPage() - 1) * $mantenimientoperifericos->perPage());
    }
    public function buscarPorUsuario(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Mantenimientoperiferico::query()
            ->leftJoin('users', 'mantenimientoperiferico.users_id', '=', 'users.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('users.id', '=', $busqueda);
                    } else {
                        $query->orWhere('users.name', '=', $busqueda);
                    }
                });
        }

        $mantenimientoperifericos = $query->select([
            'mantenimientoperiferico.*',
            'users.name AS user_name',
        ])->orderBy('mantenimientoperiferico.created_at', 'desc')->paginate();
        $mantenimientoperifericos->appends(['busqueda' => $busqueda]);
        return view('mantenimientoperiferico.index', compact('mantenimientoperifericos'))
            ->with('i', ($mantenimientoperifericos->currentPage() - 1) * $mantenimientoperifericos->perPage());
    }

    public function buscarPorEquipo(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Mantenimientoperiferico::query()
        ->leftJoin('perifericosyauxiliares', 'mantenimientoperiferico.perifericos_id', '=', 'perifericosyauxiliares.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('perifericos_id', '=', $busqueda);
                    }
                });
        }

        $mantenimientoperifericos = $query->orderBy('mantenimientoperiferico.created_at', 'desc')->paginate();
        $mantenimientoperifericos->appends(['busqueda' => $busqueda]);
        return view('mantenimientoperiferico.index', compact('mantenimientoperifericos'))
            ->with('i', ($mantenimientoperifericos->currentPage() - 1) * $mantenimientoperifericos->perPage());
    }

    public function buscarPorTipoMantenimiento(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Mantenimientoperiferico::query()
            ->leftJoin('tipoMantenimiento', 'mantenimientoperiferico.id_tipo_mantenimiento', '=', 'tipoMantenimiento.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('tipoMantenimiento.id', '=', $busqueda);
                    } else {
                        $query->orWhere('tipoMantenimiento.descripcion', '=', $busqueda);
                    }
                });
        }

        $mantenimientoperifericos = $query->select([
            'mantenimientoperiferico.*',
            'tipoMantenimiento.descripcion AS tipoMantenimiento_descripcion',
        ])->orderBy('mantenimientoperiferico.created_at', 'desc')->paginate();
        $mantenimientoperifericos->appends(['busqueda' => $busqueda]);
        return view('mantenimientoperiferico.index', compact('mantenimientoperifericos'))
            ->with('i', ($mantenimientoperifericos->currentPage() - 1) * $mantenimientoperifericos->perPage());
    }

    public function buscarPorFecha(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Mantenimientoperiferico::query();

        if ($busqueda) {
            $formattedDate = date('Y-m-d', strtotime($busqueda));
            $query->where('fecha', 'LIKE', '%' . $formattedDate . '%');
        }

        $mantenimientoperifericos = $query->orderBy('mantenimientoperiferico.created_at', 'desc')->paginate();
        $mantenimientoperifericos->appends(['busqueda' => $busqueda]);
        return view('mantenimientoperiferico.index', compact('mantenimientoperifericos'))
            ->with('i', ($mantenimientoperifericos->currentPage() - 1) * $mantenimientoperifericos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mantenimientoperiferico = new Mantenimientoperiferico();
        $tipomantenimiento = TipoMantenimiento::pluck('descripcion','id');
        $user = User::all();
        $equipo = Perifericosyauxiliare::all();
        return view('mantenimientoperiferico.create', compact('mantenimientoperiferico','tipomantenimiento','user','equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Mantenimientoperiferico::$rules);

        date_default_timezone_set('America/Bogota');

        $fields = [
            'users_id' => $request->input('users_id'),
            'perifericos_id' => $request->input('perifericos_id'),
            'id_tipo_mantenimiento' => $request->input('id_tipo_mantenimiento'),
            'descripcion' => $request->input('descripcion'),
            'fecha' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $mantenimientoperiferico = Mantenimientoperiferico::create($fields);

        return redirect()->route('mantenimientoperiferico.index')
            ->with('success', 'Mantenimiento registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mantenimientoperiferico = Mantenimientoperiferico::find($id);

        return view('mantenimientoperiferico.show', compact('mantenimientoperiferico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mantenimientoperiferico = Mantenimientoperiferico::find($id);
        $tipomantenimiento = TipoMantenimiento::pluck('descripcion','id');
        $user = User::all();
        $equipo = Perifericosyauxiliare::all();
        return view('mantenimientoperiferico.edit', compact('mantenimientoperiferico','tipomantenimiento','user','equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Mantenimientoperiferico $mantenimientoperiferico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantenimientoperiferico $mantenimientoperiferico)
    {
        request()->validate(Mantenimientoperiferico::$rules);

        $mantenimientoperiferico->update($request->all());

        return redirect()->route('mantenimientoperiferico.index')
            ->with('success', 'Mantenimiento actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mantenimientoperiferico = Mantenimientoperiferico::find($id)->delete();

        return redirect()->route('mantenimientoperiferico.index')
            ->with('success', 'Mantenimiento eliminado correctamente');
    }
}
