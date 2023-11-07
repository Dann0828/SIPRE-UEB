<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MailController;
use App\Models\Edificio;
use App\Models\EstadoComputador;
use App\Models\Perifericosyauxiliare;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Prestamop;
use App\Models\Salon;
use App\Models\Rol;
use App\Models\Tipoaula;
use App\Models\Dependenciaua;
use App\Models\Tipoaux;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

/**
 * Class PrestamoController
 * @package App\Http\Controllers
 */
class PrestamopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamop = Prestamop::orderBy('prestamop.created_at', 'desc')->paginate();

        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarPorId(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $prestamop = $query->orderBy('prestamop.created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarPorPersona(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query()
            ->leftJoin('persona', 'prestamop.persona_id', '=', 'persona.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('persona.id', '=', $busqueda);
                    } else {
                        $query->orWhere('persona.nombre', '=', $busqueda);
                    }
                });
        }

        $prestamop = $query->select([
            'prestamop.*',
            'persona.nombre AS persona_nombre',
        ])->orderBy('prestamop.created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarPorUsuario(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query()
            ->leftJoin('users', 'prestamop.users_id', '=', 'users.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('users.id', '=', $busqueda);
                    } else {
                        $query->orWhere('users.name', '=', $busqueda);
                    }
                });
        }

        $prestamop = $query->select([
            'prestamop.*',
            'users.name AS user_name',
        ])->orderBy('prestamop.created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarPorEquipo(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query();

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('perifericosyauxiliares_id', '=', $busqueda);
                    }
                });
        }

        $prestamop = $query->orderBy('prestamop.created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }
    public function buscarPorFechaPrestamo(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query();

        if ($busqueda) {
            $formattedDate = date('Y-m-d', strtotime($busqueda));
            $query->where('fecha_hora_prestamo', 'LIKE', '%' . $formattedDate . '%');
        }

        $prestamop = $query->orderBy('created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarPorFechaEntrega(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query();

        if ($busqueda) {
            $formattedDate = date('Y-m-d', strtotime($busqueda));
            $query->where('fecha_hora_entrega', 'LIKE', '%' . $formattedDate . '%');
        }

        $prestamop = $query->orderBy('created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarPorEstado(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamop::query();

        if ($busqueda) {
            $query->Where('estado', '=', $busqueda);
        }

        $prestamop = $query->orderBy('prestamop.created_at', 'desc')->paginate();
        $prestamop->appends(['busqueda' => $busqueda]);
        return view('prestamop.index', compact('prestamop'))
            ->with('i', ($prestamop->currentPage() - 1) * $prestamop->perPage());
    }

    public function buscarEstudianteEnAPI(Request $request)
    {

        $documentNumber = $request->input('busqueda');
    
        $url = 'https://dipw1jnuj6.execute-api.us-east-1.amazonaws.com';
    
        $username = 'sipreueb';
        $password = 'SipreUeb2023!';
    
        $endpoint = "/?option=integracionSiproSala&task=getStudentInfo&document=$documentNumber";
    
        $response = Http::withBasicAuth($username, $password)
            ->get($url . $endpoint);

        $responseData = $response->json();

        $request->session()->put('tipo_formulario', 'form');


            $rol = Rol::find(1);
            $rolE = 0;
            
            if ($rol) {
                $rolE = 1;
            } else {
                $rol = new Rol();
                $rol->id = 1;
                $rol->descripcion = 'Estudiante';
                $rol->save();  
            }
    
            $rol = Rol::find(1);
            if ($rol) {
                $rolE = 1;
            }

            $persona = null;
            $message = sprintf('El estudiante con numero de documento %s no se encuentra activo para ninguna carrera en la universidad', $documentNumber);
        
            if ($responseData['status'] === 'success') {
                $careerNames = $responseData['message']['careerName'];

                $programaIds = [];
                foreach ($careerNames as $careerName) {
                    $programa = Programa::where('nombre', $careerName)->first();
                    
                    if ($programa) {
                        $programaIds[] = $programa->id;
                    } else {
                        return redirect()->route('programa.create')->with('error', 'El programa '.$careerName.' enviado por la API no existe, por favor registrelo antes de continuar.');
                    }
                }
                                
                $personaId = $responseData['message']['document'];
                $persona = Persona::updateOrCreate(
                    ['id' => $personaId],
                    [
                        'nombre' => $responseData['message']['completeName'],
                        'correo' => $responseData['message']['email'],
                        'celular' => $responseData['message']['phone'],
                        'estado' => "Activo"
                    ]
                );
                $persona = Persona::find($documentNumber);
                $persona->programas()->sync($programaIds);
                $persona->roles()->sync($rolE);
                return redirect()->route('prestamop.create')->with('busqueda', $documentNumber);
            } elseif ($responseData['status'] === 'failure' && $responseData['message'] === $message) {
                $persona = Persona::find($documentNumber);
                if($persona){
                    $persona->update(['estado' => 'Inactivo']);
                    return redirect()->route('prestamop.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                } else{
                    return redirect()->route('prestamop.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                }
            } else {
                $persona = Persona::find($documentNumber);
                if ($persona) {
                    $roles = $persona->roles;
                    $isAdministrativoOrDocente = $roles->contains(function ($role, $key) {
                        return $role->descripcion === 'Administrativo' || $role->descripcion === 'Docente';
                    });
                
                    if ($isAdministrativoOrDocente) {
                        return redirect()->route('prestamo.index')->with('error', 'Esta persona no es estudiante.');
                    }
                    return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
                } else {
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra registrada.');
                } 
            }
    }
    

    public function buscarDocenteEnAPI(Request $request)
    {

        $documentNumber = $request->input('busqueda');
    
        $url = 'https://dipw1jnuj6.execute-api.us-east-1.amazonaws.com';
    
        $username = 'sipreueb';
        $password = 'SipreUeb2023!';
    
        $endpoint = "/?option=integracionSiproSala&task=getProfessorInfo&document=$documentNumber";
    
        $response = Http::withBasicAuth($username, $password)
            ->get($url . $endpoint);

        $responseData = $response->json();

        $request->session()->put('tipo_formulario', 'form');

            $rol = Rol::find(2);
            $rolD = 0;
            
            if ($rol) {
                $rolD = 2;
            } else {
                $rol = new Rol();
                $rol->id = 2;
                $rol->descripcion = 'Docente';
                $rol->save();  
            }
    
            $rol = Rol::find(2);
            if ($rol) {
                $rolD = 2;
            }
            $persona = null;
            $message = sprintf('El profesor con numero de documento %s no se encuentra activo en la universidad', $documentNumber);
        
            if ($responseData['status'] === 'success') {
                $personaId = $responseData['message']['document'];
                $persona = Persona::updateOrCreate(
                    ['id' => $personaId],
                    [
                        'nombre' => $responseData['message']['completeName'],
                        'correo' => $responseData['message']['email'],
                        'celular' => $responseData['message']['phone'],
                        'estado' => 'Activo'
                    ]
                );
                $persona = Persona::find($documentNumber);
                $persona->roles()->sync($rolD);
                return redirect()->route('prestamop.create')->with('busqueda', $documentNumber);
            } elseif ($responseData['status'] === 'failure' && $responseData['message'] === $message) {
                $persona = Persona::find($documentNumber);
                if($persona){
                    $persona->update(['estado' => 'Inactivo']);
                    return redirect()->route('prestamop.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                } else{
                    return redirect()->route('prestamop.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                }
            } else {
                $persona = Persona::find($documentNumber);
                if ($persona) {
                    $roles = $persona->roles;
                    $isEstudianteOrAdministrativo = $roles->contains(function ($role, $key) {
                        return $role->descripcion === 'Estudiante' || $role->descripcion === 'Administrativo';
                    });
                
                    if ($isEstudianteOrAdministrativo) {
                        return redirect()->route('prestamo.index')->with('error', 'Esta persona no es docente.');
                    }
                    return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
                } else {
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra registrada.');
                } 
            }
    }

    public function buscarAdministrativoEnAPI(Request $request)
    {
        $documentNumber = $request->input('busqueda');
    
        $url = 'https://dipw1jnuj6.execute-api.us-east-1.amazonaws.com';
    
        $username = 'sipreueb';
        $password = 'SipreUeb2023!';
    
        $endpoint = "/?option=integracionSiproSala&task=getAdministrativeUserInfo&document=$documentNumber";
    
        $response = Http::withBasicAuth($username, $password)->get($url . $endpoint);
        $responseData = $response->json();

        $request->session()->put('tipo_formulario', 'forma');

        $rol = Rol::find(3);
        $rolA = 0;
        
        if ($rol) {
            $rolA = 3;
        } else {
            $rol = new Rol();
            $rol->id = 3;
            $rol->descripcion = 'Administrativo';
            $rol->save();  
        }

        $rol = Rol::find(3);
        if ($rol) {
            $rolA = 3;
        }
    
        $persona = null;
        $message = sprintf('El administrativo con numero de documento %s no se encuentra activo en la universidad', $documentNumber);
    
        if ($responseData['status'] === 'success') {
            $personaId = $responseData['message']['document'];
            $persona = Persona::updateOrCreate(
                ['id' => $personaId],
                [
                    'nombre' => $responseData['message']['completeName'],
                    'correo' => $responseData['message']['email'],
                    'celular' => $responseData['message']['phone'],
                    'estado' => 'Activo'
                ]
            );
            $persona = Persona::find($documentNumber);
            $persona->roles()->sync($rolA);
            return redirect()->route('prestamop.create')->with('busqueda', $documentNumber);
        } elseif ($responseData['status'] === 'failure' && $responseData['message'] === $message) {
            $persona = Persona::find($documentNumber);
            if($persona){
                $persona->update(['estado' => 'Inactivo']);
                return redirect()->route('prestamop.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
            } else{
                return redirect()->route('prestamop.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
            }
        } else {
            $persona = Persona::find($documentNumber);
            if ($persona) {
                $roles = $persona->roles;
                $isEstudianteOrDocente = $roles->contains(function ($role, $key) {
                    return $role->descripcion === 'Estudiante' || $role->descripcion === 'Docente';
                });
            
                if ($isEstudianteOrDocente) {
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no es administrativo.');
                }
                return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
            } else {
                return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra registrada.');
            } 
        }
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $busqueda = $request->session()->get('busqueda');
        $prestamop = new Prestamop();
        $user = User::pluck('name','id');
        $persona = Persona::where('id', $busqueda)->where('estado', 'Activo')->get();
        $aula = Salon::all();
        $dependencias = Dependenciaua::pluck('dependencia','id');
        $edificio = Edificio::whereIn('id', function ($query) {
            $query->select('edificio_id')
                ->from('salon');
        })->pluck('descripcion');
        $tipoaula = Tipoaula::whereIn('id', function ($query) {
            $query->select('tipoaula_id')
                ->from('salon');
        })->pluck('descripcion');
        $perifericosyauxiliares = Perifericosyauxiliare::join('estadoComputador', 'perifericosyauxiliares.id_estado', '=', 'estadoComputador.id')
        ->where('estadoComputador.estado_computador', 'Disponible')
        ->select('perifericosyauxiliares.*')
        ->get();
        $tipoaux = Tipoaux::whereIn('id', function ($query) {
            $query->select('id_tipoaux')
                ->from('perifericosyauxiliares');
        })->pluck('tipo_aux');
        $programas = Persona::join('persona_programa', 'persona.id', '=', 'persona_programa.persona_id')
        ->join('programa', 'persona_programa.programa_id', '=', 'programa.id')
        ->where('persona.id', '=', $busqueda)
        ->pluck('programa.nombre','programa.id');
        if($programas->isEmpty()){
            $programas = Programa::pluck('nombre','id');
        } 
        return view('prestamop.create', compact('prestamop','user','persona','perifericosyauxiliares','tipoaux','aula','edificio','tipoaula','programas','dependencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         $persona = Persona::find($request->input('persona_id'));

         if ($persona && $persona->estado === 'Inactivo') {
             return redirect()->route('prestamop.index')
                 ->with('error', 'Esta persona se encuentra inactiva.');
         }

         $perifericosSeleccionados = $request->input('equipo_id');
         $estadoPrestado = 'Prestado';
         date_default_timezone_set('America/Bogota');

         foreach ($perifericosSeleccionados as $perifericoId) {
             $fields = [
                 'users_id' => $request->input('users_id'),
                 'persona_id' => $request->input('persona_id'),
                 'perifericosyauxiliares_id' => $perifericoId,
                 'salon_id' => $request->input('salon_id'),
                 'fecha_hora_prestamo' => date('Y-m-d H:i:s'),
                 'estado' => $estadoPrestado,
                 'created_at' => date('Y-m-d H:i:s'),
                 'updated_at' => date('Y-m-d H:i:s'),
             ];

             if ($fields['estado'] === 'Prestado') {
                 $estadoEnPrestamo = EstadoComputador::where('estado_computador', 'En Préstamo')->pluck('id')->first();
                 if ($estadoEnPrestamo) {
                     $fields['id_estado'] = $estadoEnPrestamo;

                     DB::table('perifericosyauxiliares')
                         ->where('id', $perifericoId)
                         ->update(['id_estado' => $estadoEnPrestamo]);
                 }
             }

             $prestamop = Prestamop::create($fields);
         }

         $programasSeleccionados = $request->input('programa_id');
         $dependenciasSeleccionadas = $request->input('dependencia_id');
         $prestamopId = $prestamop->id;
         $this->asociarProgramas($prestamopId, $programasSeleccionados);
         $this->asociarDependencias($prestamopId, $dependenciasSeleccionadas);

         return redirect()->route('prestamop.index')
             ->with('success', 'Préstamo registrado correctamente.');
     }

     public function asociarProgramas($prestamopId, $programaIds)
     {
         $prestamop = Prestamop::findOrFail($prestamopId);
         $prestamop->programas()->attach($programaIds);
         return redirect()->route('prestamop.index')
             ->with('success', 'Préstamo registrado correctamente.');
     }

     public function asociarDependencias($prestamopId, $dependenciasIds)
     {
         $prestamop = Prestamop::findOrFail($prestamopId);
         $prestamop->dependencias()->attach($dependenciasIds);
         return redirect()->route('prestamop.index')
             ->with('success', 'Préstamo registrado correctamente.');
     }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamop = Prestamop::find($id);
        $edificio = Edificio::whereIn('id', function ($query) use ($prestamop) {
            $query->select('edificio_id')
                ->from('salon')
                ->where('id', $prestamop->salon_id);
        })->first();

        $tipoaula = Tipoaula::whereIn('id', function ($query) use ($prestamop) {
            $query->select('tipoaula_id')
                ->from('salon')
                ->where('id', $prestamop->salon_id);
        })->first();
        $idp = $prestamop->id;
        $programas = Prestamop::join('prestamop_programa', 'prestamop.id', '=', 'prestamop_programa.prestamop_id')
        ->join('programa', 'prestamop_programa.programa_id', '=', 'programa.id')
        ->where('prestamop.id', '=', $idp)
        ->pluck('programa.nombre');
        $dependencias = Prestamop::join('prestamop_dependencia', 'prestamop.id', '=', 'prestamop_dependencia.prestamop_id')
        ->join('dependenciaua', 'prestamop_dependencia.dependenciaua_id', '=', 'dependenciaua.id')
        ->where('prestamop.id', '=', $idp)
        ->pluck('dependenciaua.dependencia'); 
        return view('prestamop.show', compact('prestamop', 'edificio', 'tipoaula','programas','dependencias'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamop = Prestamop::find($id);

        return view('prestamop.edit', compact('prestamop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prestamop $prestamop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamop $prestamop)
    {

        if ($prestamop->estado === "Finalizado") {
            return redirect()->route('prestamop.index')
                ->with('error', 'Este préstamo ya se cerró.');
        } else {
            $estado = EstadoComputador::where('estado_computador', 'Disponible')->pluck('id')->first();
            if ($estado) {
                $fields['id_estado'] = $estado;
                DB::table('perifericosyauxiliares')
                    ->where('id', $prestamop->perifericosyauxiliares_id)
                    ->update(['id_estado' => $estado]);
            }
            date_default_timezone_set('America/Bogota');
            $prestamop->fecha_hora_entrega = date('Y-m-d H:i:s');
            $prestamop->observaciones = $request->input('observaciones');
            $prestamop->estado = "Finalizado";
            $prestamop->save();
            $persona = $prestamop->persona_id;
            $mailController = new MailController();
            $mailController->sendEmail($persona);
            try {
                $mailController->sendEmail($persona);
            } catch (\Exception $e) {
                return redirect()->route('prestamo.index', ['prestamo' => $prestamop])
                    ->with('error', 'No se pudo enviar el correo, por favor revisa la dirección de correo electrónico.');
            }
            return redirect()->route('prestamop.index')
                ->with('success', 'Préstamo finalizado correctamente.');
        }
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prestamo = Prestamop::find($id)->delete();

        return redirect()->route('prestamo.index')
            ->with('success', 'Préstamo eliminado correctamente.');
    }
}
