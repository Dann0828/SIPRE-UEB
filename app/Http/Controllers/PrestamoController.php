<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\EstadoComputador;
use App\Models\Ordenador;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Prestamo;
use App\Models\Salon;
use App\Models\Rol;
use App\Models\Tipoaula;
use App\Models\Dependenciaua;
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
class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamo = Prestamo::orderBy('prestamo.created_at', 'desc')->paginate();

        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorId(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $prestamo = $query->orderBy('prestamo.created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorPersona(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query()
            ->leftJoin('persona', 'prestamo.persona_id', '=', 'persona.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('persona.id', '=', $busqueda);
                    } else {
                        $query->orWhere('persona.nombre', '=', $busqueda);
                    }
                });
        }

        $prestamo = $query->select([
            'prestamo.*',
            'persona.nombre AS persona_nombre',
        ])->orderBy('prestamo.created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorUsuario(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query()
            ->leftJoin('users', 'prestamo.users_id', '=', 'users.id');

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('users.id', '=', $busqueda);
                    } else {
                        $query->orWhere('users.name', '=', $busqueda);
                    }
                });
        }

        $prestamo = $query->select([
            'prestamo.*',
            'users.name AS user_name',
        ])->orderBy('prestamo.created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorEquipo(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query();

            if ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    if (is_numeric($busqueda)) {
                        $query->orWhere('equipo_id', '=', $busqueda);
                    }
                });
        }

        $prestamo = $query->orderBy('prestamo.created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorFechaPrestamo(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query();

        if ($busqueda) {
            $formattedDate = date('Y-m-d', strtotime($busqueda));
            $query->where('fecha_hora_prestamo', 'LIKE', '%' . $formattedDate . '%');
        }

        $prestamo = $query->orderBy('created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorFechaEntrega(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query();

        if ($busqueda) {
            $formattedDate = date('Y-m-d', strtotime($busqueda));
            $query->where('fecha_hora_entrega', 'LIKE', '%' . $formattedDate . '%');
        }

        $prestamo = $query->orderBy('created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
    }

    public function buscarPorEstado(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = Prestamo::query();

        if ($busqueda) {
            $query->Where('estado', '=', $busqueda);
        }

        $prestamo = $query->orderBy('prestamo.created_at', 'desc')->paginate();
        $prestamo->appends(['busqueda' => $busqueda]);
        return view('prestamo.index', compact('prestamo'))
            ->with('i', ($prestamo->currentPage() - 1) * $prestamo->perPage());
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
                return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
            } elseif ($responseData['status'] === 'failure' && $responseData['message'] === $message) {
                $persona = Persona::find($documentNumber);
                if($persona){
                    $persona->update(['estado' => 'Inactivo']);
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                } else{
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                }
            } else {
                $persona = Persona::find($documentNumber);
                if ($persona) {
                    $roles = $persona->roles;
                    $isDocenteOrAdministrativo = $roles->contains(function ($role, $key) {
                        return $role->descripcion === 'Docente' || $role->descripcion === 'Administrativo';
                    });
                
                    if ($isDocenteOrAdministrativo) {
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
    
        $response = Http::withBasicAuth($username, $password)->get($url . $endpoint);
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
                return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
            } elseif ($responseData['status'] === 'failure' && $responseData['message'] === $message) {
                $persona = Persona::find($documentNumber);
                if($persona){
                    $persona->update(['estado' => 'Inactivo']);
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
                } else{
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
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
            return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
        } elseif ($responseData['status'] === 'failure' && $responseData['message'] === $message) {
            $persona = Persona::find($documentNumber);
            if($persona){
                $persona->update(['estado' => 'Inactivo']);
                return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
            } else{
                return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra activa en la universidad.');
            }
        } else {
            $persona = Persona::find($documentNumber);
            if ($persona) {
                $roles = $persona->roles;
                $isEstudianteOrDocente = $roles->contains(function ($role, $key) {
                    return $role->descripcion === 'Estudiante' || $role->descripcion === 'Docente';
                });
            
                if ($isEstudianteOrDocente) {
                    return redirect()->route('prestamo.index')->with('error', 'Esta persona no es adminsitrativo.');
                }
                return redirect()->route('prestamo.create')->with('busqueda', $documentNumber);
            } else {
                return redirect()->route('prestamo.index')->with('error', 'Esta persona no se encuentra registrada.');
            } 
        }
    }    
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $busqueda = $request->session()->get('busqueda');
        $prestamo = new Prestamo();
        $user = User::pluck('name', 'id');
        $persona = Persona::where('id', $busqueda)->where('estado', 'Activo')->get();
        $programas = Persona::join('persona_programa', 'persona.id', '=', 'persona_programa.persona_id')
        ->join('programa', 'persona_programa.programa_id', '=', 'programa.id')
        ->where('persona.id', '=', $busqueda)
        ->pluck('programa.nombre','programa.id');
        $dependencias = Dependenciaua::pluck('dependencia','id');
        if($programas->isEmpty()){
            $programas = Programa::pluck('nombre','id');
        }     
        $equipos = Ordenador::join('tipoComputador as t', 'ordenador.id_tipoComputador', '=', 't.id')
            ->join('estadoComputador as e', 'ordenador.id_estado', '=', 'e.id')
            ->where('t.tipo_computador', 'Portátil')
            ->where('e.estado_computador', 'Disponible')
            ->select('ordenador.*')
            ->get();
        $aula = Salon::all();
        $edificio = Edificio::whereIn('id', function ($query) {
            $query->select('edificio_id')->from('salon');
        })->pluck('descripcion');
    
        $tipoaula = Tipoaula::whereIn('id', function ($query) {
            $query->select('tipoaula_id')->from('salon');
        })->pluck('descripcion');
    
        return view('prestamo.create', compact('prestamo', 'user', 'persona', 'equipos', 'aula', 'edificio', 'tipoaula','programas','dependencias'));
    }

    public function store(Request $request)
    {
        $persona = Persona::find($request->input('persona_id'));

        if ($persona && $persona->estado === 'Inactivo') {
            return redirect()->route('prestamop.index')
                ->with('error', 'Esta persona se encuentra inactiva.');
        }

        $ordenadoresSeleccionados = $request->input('equipo_id');
        $estadoPrestado = 'Prestado';
        date_default_timezone_set('America/Bogota');

        foreach ($ordenadoresSeleccionados as $ordenadorId) {
            $fields = [
                'users_id' => $request->input('users_id'),
                'persona_id' => $request->input('persona_id'),
                'equipo_id' => $ordenadorId,
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

                    DB::table('ordenador')
                        ->where('id', $ordenadorId)
                        ->update(['id_estado' => $estadoEnPrestamo]);
                }
            }

            $prestamo = Prestamo::create($fields);
        }

        $programasSeleccionados = $request->input('programa_id');
        $dependenciasSeleccionadas = $request->input('dependencia_id');
        $prestamoId = $prestamo->id;
        $this->asociarProgramas($prestamoId, $programasSeleccionados);
        $this->asociarDependencias($prestamoId, $dependenciasSeleccionadas);

        return redirect()->route('prestamo.index')
            ->with('success', 'Préstamo registrado correctamente.');
    }

    public function asociarProgramas($prestamoId, $programaIds)
    {
        $prestamo = Prestamo::findOrFail($prestamoId);
        $prestamo->programas()->attach($programaIds);
        return redirect()->route('prestamo.index')
            ->with('success', 'Préstamo registrado correctamente.');
    }

    public function asociarDependencias($prestamoId, $dependenciasIds)
    {
        $prestamo = Prestamo::findOrFail($prestamoId);
        $prestamo->dependencias()->attach($dependenciasIds);
        return redirect()->route('prestamo.index')
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
        $prestamo = Prestamo::find($id);    
        $edificio = Edificio::whereIn('id', function ($query) use ($prestamo) {
            $query->select('edificio_id')
                ->from('salon')
                ->where('id', $prestamo->salon_id);
        })->first();
        $tipoaula = Tipoaula::whereIn('id', function ($query) use ($prestamo) {
            $query->select('tipoaula_id')
                ->from('salon')
                ->where('id', $prestamo->salon_id);
        })->first();
        $idp = $prestamo->id;
        $programas = Prestamo::join('prestamo_programa', 'prestamo.id', '=', 'prestamo_programa.prestamo_id')
        ->join('programa', 'prestamo_programa.programa_id', '=', 'programa.id')
        ->where('prestamo.id', '=', $idp)
        ->pluck('programa.nombre');
        $dependencias = Prestamo::join('prestamo_dependencia', 'prestamo.id', '=', 'prestamo_dependencia.prestamo_id')
        ->join('dependenciaua', 'prestamo_dependencia.dependenciaua_id', '=', 'dependenciaua.id')
        ->where('prestamo.id', '=', $idp)
        ->pluck('dependenciaua.dependencia'); 
        return view('prestamo.show', compact('prestamo','edificio','tipoaula','programas','dependencias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);

        return view('prestamo.edit', compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prestamo $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
{

    if ($prestamo->estado === "Finalizado") {
        return redirect()->route('prestamo.index')
            ->with('error', 'Este préstamo ya se cerró.');
    } else{
        $estado = EstadoComputador::where('estado_computador', 'Disponible')->pluck('id')->first();
            if ($estado) {
                $fields['id_estado'] = $estado;
                DB::table('ordenador')
                    ->where('id', $prestamo->equipo_id)
                    ->update(['id_estado' => $estado]);
            }

            date_default_timezone_set('America/Bogota');
            $prestamo->fecha_hora_entrega = date('Y-m-d H:i:s');
            $prestamo->observaciones = $request->input('observaciones');
            $prestamo->estado = "Finalizado";
            $prestamo->save();
            $persona = $prestamo->persona_id;
            $mailController = new MailController();

        try {
            $mailController->sendEmail($persona);
            return redirect()->route('prestamo.index')
            ->with('success', 'Préstamo finalizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('prestamo.index', ['prestamo' => $prestamo])
                ->with('error', 'No se pudo enviar el correo, por favor revisa la dirección de correo electrónico.');
        }
    }
}


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id)->delete();

        return redirect()->route('prestamo.index')
            ->with('success', 'Préstamo eliminado correctamente.');
    }
}
