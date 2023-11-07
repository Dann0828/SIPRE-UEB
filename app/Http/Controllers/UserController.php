<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $query = User::query();

        if ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                $query->where('name', '=' , $busqueda);
                if (is_numeric($busqueda)) {
                    $query->orWhere('id', '=', $busqueda);
                }
            });
        }

        $users = $query->paginate();

        $userRoles = [];

        foreach ($users as $user) {
            $tipoUsuario = ModelHasRole::where('model_id', $user->id)->first();
            if ($tipoUsuario) {
                $role_id = $tipoUsuario->role_id;
                $nombre = '';
                if ($role_id === 1) {
                    $nombre = 'Administrador';
                } elseif ($role_id === 2) {
                    $nombre = 'Técnico';
                } else if ($role_id === 3){
                    $nombre = 'Otro';
                }
                $userRoles[$user->id] = $nombre;
            } else {
                $userRoles[$user->id] = 'Sin Rol';
            }
        }

        return view('user.index', compact('users', 'userRoles'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => ['required', 'int', 'min:5'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', Rules\Password::defaults()],
        ]);

        $id = User::where('id', $request->input('id'))->first();
        $correo = User::where('email', $request->input('correo'))->first();
    
        if ($id) {
            return redirect()->route('user.index')
                ->with('error', 'Esa cédula ya se encuentra registrada.');
        } elseif ($correo) {
            return redirect()->route('user.index')
                ->with('error', 'Ese correo ya se encuentra registrado.');
        } else{
            $user = User::create([
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $tipodeUsuario = $request->input('tipodeUsuario');
    
            if ($tipodeUsuario === 'Administrador') {
                $aux = 1;
            } elseif ($tipodeUsuario === 'Técnico') {
                $aux = 2;
            }
    
            $tipoUsuario = new ModelHasRole();
            $tipoUsuario->timestamps = false;
            $tipoUsuario->role_id = $aux;
            $tipoUsuario->model_type = 'App\Models\User';
            $tipoUsuario->model_id = $user->id;
            $tipoUsuario->save();
    
            return redirect()->route('user.index')
                ->with('success', 'Usuario creado correctamente.');
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
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'id' => ['required', 'int', 'min:5'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', Rules\Password::defaults()],
        ]);

        $user->update([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $tipodeUsuario = $request->input('tipodeUsuario');

        if ($tipodeUsuario === 'Administrador') {
            $aux = 1;
        } elseif ($tipodeUsuario === 'Técnico') {
            $aux = 2;
        }

        DB::table('model_has_roles')
        ->updateOrInsert(
            [
                'model_type' => 'App\Models\User',
                'model_id' => $user->id,
            ],
            ['role_id' => $aux]
        );

        return redirect()->route('user.index')
            ->with('success', 'Usuario actualizado correctamente');
    }



    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
