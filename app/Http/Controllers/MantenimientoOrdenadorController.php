<?php

namespace App\Http\Controllers;

use App\Models\Hojavidaordenador;
use App\Models\SalonOrdenador;
use App\Models\MantenimientoOrdenador;
use App\Models\Ordenador;
use App\Models\Salon;
use App\Models\TipoCambio;
use App\Models\TipoMantenimiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Class MantenimientoOrdenadorController
 * @package App\Http\Controllers
 */
class MantenimientoOrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimientoOrdenadors = MantenimientoOrdenador::orderBy('mantenimiento_ordenador.created_at', 'desc')->paginate();

        return view('mantenimiento-ordenador.index', compact('mantenimientoOrdenadors'))
            ->with('i', ($mantenimientoOrdenadors->currentPage() - 1) * $mantenimientoOrdenadors->perPage());
    }

    public function buscarPorId(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = MantenimientoOrdenador::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $mantenimientoOrdenadors = $query->orderBy('mantenimiento_ordenador.created_at', 'desc')->paginate();
        $mantenimientoOrdenadors->appends(['busqueda' => $busqueda]);
        return view('mantenimiento-ordenador.index', compact('mantenimientoOrdenadors'))
            ->with('i', ($mantenimientoOrdenadors->currentPage() - 1) * $mantenimientoOrdenadors->perPage());
    }    

    public function buscarPorUsuario(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = MantenimientoOrdenador::query()
            ->leftJoin('users', 'mantenimiento_ordenador.users_id', '=', 'users.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('users.id', '=', $busqueda);
                    } else {
                        $query->orWhere('users.name', '=', $busqueda);
                    }
                });
        }

        $mantenimientoOrdenadors = $query->select([
            'mantenimiento_ordenador.*',
            'users.name AS user_name',
        ])->orderBy('mantenimiento_ordenador.created_at', 'desc')->paginate();
        $mantenimientoOrdenadors->appends(['busqueda' => $busqueda]);
        return view('mantenimiento-ordenador.index', compact('mantenimientoOrdenadors'))
            ->with('i', ($mantenimientoOrdenadors->currentPage() - 1) * $mantenimientoOrdenadors->perPage());
    }

    public function buscarPorEquipo(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = MantenimientoOrdenador::query()
        ->leftJoin('ordenador', 'mantenimiento_ordenador.ordenador_id', '=', 'ordenador.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('ordenador_id', '=', $busqueda);
                    }
                });
        }

        $mantenimientoOrdenadors = $query->orderBy('mantenimiento_ordenador.created_at', 'desc')->paginate();
        $mantenimientoOrdenadors->appends(['busqueda' => $busqueda]);
        return view('mantenimiento-ordenador.index', compact('mantenimientoOrdenadors'))
            ->with('i', ($mantenimientoOrdenadors->currentPage() - 1) * $mantenimientoOrdenadors->perPage());
    }

    public function buscarPorTipoMantenimiento(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = MantenimientoOrdenador::query()
            ->leftJoin('tipoMantenimiento', 'mantenimiento_ordenador.id_tipo_mantenimiento', '=', 'tipoMantenimiento.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('tipoMantenimiento.id', '=', $busqueda);
                    } else {
                        $query->orWhere('tipoMantenimiento.descripcion', '=', $busqueda);
                    }
                });
        }
        $mantenimientoOrdenadors = $query->select([
            'mantenimiento_ordenador.*',
            'tipoMantenimiento.descripcion AS tipoMantenimiento_descripcion',
        ])->orderBy('mantenimiento_ordenador.created_at', 'desc')->paginate();
        $mantenimientoOrdenadors->appends(['busqueda' => $busqueda]);
        return view('mantenimiento-ordenador.index', compact('mantenimientoOrdenadors'))
            ->with('i', ($mantenimientoOrdenadors->currentPage() - 1) * $mantenimientoOrdenadors->perPage());
    }

    public function buscarPorFecha(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = MantenimientoOrdenador::query();

        if ($busqueda) {
            $formattedDate = date('Y-m-d', strtotime($busqueda));
            $query->where('fecha', 'LIKE', '%' . $formattedDate . '%');
        }

        $mantenimientoOrdenadors = $query->orderBy('mantenimiento_ordenador.created_at', 'desc')->paginate();
        $mantenimientoOrdenadors->appends(['busqueda' => $busqueda]);
        return view('mantenimiento-ordenador.index', compact('mantenimientoOrdenadors'))
            ->with('i', ($mantenimientoOrdenadors->currentPage() - 1) * $mantenimientoOrdenadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mantenimientoOrdenador = new MantenimientoOrdenador();
        $tipomantenimiento = TipoMantenimiento::pluck('descripcion','id');
        $user = User::all();
        $ordenador = Ordenador::all();
        $tipocambio = TipoCambio::pluck('descripcion','id');
        return view('mantenimiento-ordenador.create', compact('mantenimientoOrdenador','tipomantenimiento','user','ordenador','tipocambio'));
    }

    public function create2()
    {
        $mantenimientoOrdenador = new MantenimientoOrdenador();
        $user = User::all();
        $salon = SalonOrdenador::all();
        return view('mantenimiento-ordenador.create2', compact('mantenimientoOrdenador', 'user', 'salon'));
     }   

     public function store2(Request $request)
     {
     
         date_default_timezone_set('America/Bogota');
     
         // Paso 1: Obtener el ID del tipo de mantenimiento "Preventivo"
         $tipoMantenimientoPreventivo = TipoMantenimiento::where('descripcion', 'Preventivo')->first();
         
         if (!$tipoMantenimientoPreventivo) {
             // Manejar el caso en el que no se encuentra el tipo de mantenimiento "Preventivo".
             return redirect()->back()->with('error', 'El tipo de mantenimiento Preventivo no existe.');
         }
     
         // Paso 2: Obtener el ID del salón seleccionado desde el formulario
         $salonId = $request->input('salon_id');
     
         // Paso 3: Encontrar los ordenadores relacionados con el salón específico
         $ordenadores = DB::table('salonOrdenador')
        ->where('salon_id', $salonId)
        ->pluck('ordenador_id');
     
         // Paso 4: Crear un registro de mantenimiento para cada ordenador
         foreach ($ordenadores as $ordenador) {
            MantenimientoOrdenador::create([
                'users_id' => $request->input('users_id'),
                'ordenador_id' => $ordenador, // No necesitas acceder a 'id' aquí
                'id_tipo_mantenimiento' => $tipoMantenimientoPreventivo->id,
                'descripcion' => $request->input('descripcion'),
                'fecha' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
    
         return redirect()->route('mantenimientoordenador.index')
            ->with('success', 'Mantenimiento actualizado correctamente.');
     }
     
 

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(MantenimientoOrdenador::$rules);

        date_default_timezone_set('America/Bogota');

        $fields = [
            'users_id' => $request->input('users_id'),
            'ordenador_id' => $request->input('ordenador_id'),
            'id_tipo_mantenimiento' => $request->input('id_tipo_mantenimiento'),
            'id_tipocambio' => $request->input('id_tipocambio'),
            'descripcion' => $request->input('descripcion'),
            'fecha' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $mantenimientoOrdenador = MantenimientoOrdenador::create($fields);
        $id_computador = $mantenimientoOrdenador->ordenador_id;
        if($mantenimientoOrdenador->id_tipo_mantenimiento === '1'){
            //Ram
            if($mantenimientoOrdenador->id_tipocambio === '1'){
            return redirect()->route('edit2',['id' => $id_computador]);
            //DiscoDuro
            }else if($mantenimientoOrdenador->id_tipocambio === '2'){
                return redirect()->route('edit3',['id' => $id_computador]);
            //Pantalla
            }else if($mantenimientoOrdenador->id_tipocambio === '3'){
                return redirect()->route('edit4',['id' => $id_computador]);
            //Sistema Operativo
            }else if($mantenimientoOrdenador->id_tipocambio === '4'){
                return redirect()->route('edit5',['id' => $id_computador]);
            }
        }
        return redirect()->route('mantenimientoordenador.index')
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
        $mantenimientoOrdenador = MantenimientoOrdenador::find($id);

        $salonId = DB::table('salonOrdenador')
            ->join('mantenimiento_ordenador', 'salonOrdenador.ordenador_id', '=', 'mantenimiento_ordenador.ordenador_id')
            ->join('salon', 'salonOrdenador.salon_id', '=', 'salon.id')
            ->where('mantenimiento_ordenador.ordenador_id', $mantenimientoOrdenador->ordenador_id)
            ->select('salonOrdenador.salon_id')
            ->first();

        if ($salonId) {
            $salon = Salon::find($salonId->salon_id);
        } else {
            // Maneja el caso en el que la consulta no devolvió resultados
            $salon = null;
        }

    
        return view('mantenimiento-ordenador.show', compact('mantenimientoOrdenador', 'salon'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mantenimientoOrdenador = MantenimientoOrdenador::find($id);
        $tipomantenimiento = TipoMantenimiento::pluck('descripcion','id');
        $user = User::all();
        $ordenador = Ordenador::all();
        $tipocambio = TipoCambio::pluck('descripcion','id'); 
        return view('mantenimiento-ordenador.edit', compact('mantenimientoOrdenador','tipomantenimiento','user','ordenador','tipocambio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MantenimientoOrdenador $mantenimientoOrdenador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MantenimientoOrdenador $mantenimientoOrdenador)
    {
   
        request()->validate(MantenimientoOrdenador::$rules);

        $mantenimientoOrdenador->update($request->all());
    
        return redirect()->route('mantenimientoordenador.index')
            ->with('success', 'Mantenimiento actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mantenimientoOrdenador = MantenimientoOrdenador::find($id)->delete();

        return redirect()->route('mantenimientoordenador.index')
            ->with('success', 'Mantenimiento eliminado correctamente');
    }
}
