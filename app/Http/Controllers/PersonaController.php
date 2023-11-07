<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Programa;
use App\Models\Rol;
use Illuminate\Http\Request;

/**
 * Class PersonaController
 * @package App\Http\Controllers
 */
class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $busqueda = $request->input('busqueda');

        $query = Persona::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                $query->where('nombre', 'LIKE', '%' . $busqueda . '%');
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $persona = $query->paginate();
        $programas = Persona::join('persona_programa', 'persona.id', '=', 'persona_programa.persona_id')
        ->join('programa', 'persona_programa.programa_id', '=', 'programa.id')
        ->where('persona.id', '=', $busqueda)
        ->select('programa.nombre')
        ->get();
        $roles = Persona::join('persona_rol', 'persona.id', '=', 'persona_rol.persona_id')
        ->join('rol', 'persona_rol.rol_id', '=', 'rol.id')
        ->where('persona.id', '=', $busqueda)
        ->select('rol.descripcion')
        ->get();
    
        return view('persona.index', compact('persona','programas','roles'))
            ->with('i', (request()->input('page', 1) - 1) * $persona->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $persona = new Persona();
        $programa = Programa::pluck('nombre','id');
        $rol = Rol::pluck('descripcion','id');
        return view('persona.create', compact('persona','programa','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Persona::$rules);
    
        $id = Persona::where('id', $request->input('id'))->first();
        $correo = Persona::where('correo', $request->input('correo'))->first();
        $celular = Persona::where('celular', $request->input('celular'))->first();
    
        if ($id) {
            return redirect()->route('persona.index')
                ->with('error', 'Esa cédula ya se encuentra registrada.');
        } elseif ($correo) {
            return redirect()->route('persona.index')
                ->with('error', 'Ese correo ya se encuentra registrado.');
        } elseif ($celular) {
            return redirect()->route('persona.index')
                ->with('error', 'Ese número de celular ya se encuentra registrado.');
        } else {
            $persona = Persona::create($request->all());
            $programasSeleccionados = $request->input('programa_id');
            $rolesSeleccionados = $request->input('rol_id');
            $personaId = $request->input('id');
            $this->asociarProgramas($personaId, $programasSeleccionados);
            $this->asociarRoles($personaId, $rolesSeleccionados);
            return redirect()->route('persona.index')
                ->with('success', 'Persona registrada correctamente.');
        }
    }
    
    public function asociarProgramas($personaId, $programaIds)
    {
        $persona = Persona::findOrFail($personaId);
        $persona->programas()->attach($programaIds);
        return redirect()->route('persona.index')
            ->with('success', 'Persona registrada correctamente.');
    }

    public function asociarRoles($personaId, $rolIds)
    {
        $persona = Persona::findOrFail($personaId);
        $persona->roles()->attach($rolIds);
        return redirect()->route('persona.index')
            ->with('success', 'Persona registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::find($id);
        $programas = Persona::join('persona_programa', 'persona.id', '=', 'persona_programa.persona_id')
        ->join('programa', 'persona_programa.programa_id', '=', 'programa.id')
        ->where('persona.id', '=', $id)
        ->select('programa.nombre')
        ->get();
        $roles = Persona::join('persona_rol', 'persona.id', '=', 'persona_rol.persona_id')
        ->join('rol', 'persona_rol.rol_id', '=', 'rol.id')
        ->where('persona.id', '=', $id)
        ->select('rol.descripcion')
        ->get();
        return view('persona.show', compact('persona','programas','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);
        $programa = Programa::pluck('nombre','id');
        $rol = Rol::pluck('descripcion','id');
        return view('persona.edit', compact('persona','programa','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {

        $persona->update($request->all());

        $personaId = $persona->id;

        $programasSeleccionados = $request->input('programa_id');
        $rolesSeleccionados = $request->input('rol_id');
        $persona = Persona::find($personaId);

        $persona->programas()->sync($programasSeleccionados);

        $persona->roles()->sync($rolesSeleccionados);

        return redirect()->route('persona.index')
            ->with('success', 'Datos actualizados correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $persona = Persona::find($id)->delete();

        return redirect()->route('persona.index')
            ->with('success', 'Persona eliminada correctamente');
    }
}
