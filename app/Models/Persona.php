<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 *
 * @property $id
 * @property $nombre
 * @property $correo
 * @property $celular
 * @property $programa_id
 * @property $rol_id
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Prestamo[] $prestamos
 * @property Programa $programa
 * @property Rol $rol
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Persona extends Model
{

    protected $table = 'persona';

    static $rules = [
        'id' => 'required',
		'nombre' => 'required',
		'correo' => 'required',
        'celular' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','correo','celular','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Models\Prestamo', 'persona_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function programas()
    {
        return $this->belongsToMany(Programa::class, 'persona_programa', 'persona_id', 'programa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'persona_rol', 'persona_id', 'rol_id');
    }


}