<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestamo
 *
 * @property $id
 * @property $users_id
 * @property $persona_id
 * @property $equipo_id
 * @property $fecha_hora_prestamo
 * @property $fecha_hora_entrega
 * @property $estado
 * @property $observaciones
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordenador $equipo
 * @property Persona $persona
 * @property User $user
 * @property Salon $salon
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prestamo extends Model
{

    protected $table = 'prestamo';

    static $rules = [
		'users_id' => 'required',
		'persona_id' => 'required',
		'equipo_id' => 'required',
        'salon_id' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id','persona_id','equipo_id','salon_id','observaciones','fecha_hora_prestamo','fecha_hora_entrega','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function equipo()
    {
        return $this->hasOne('App\Models\Ordenador', 'id', 'equipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function persona()
    {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salon()
    {
        return $this->hasOne('App\Models\Salon', 'id', 'salon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function programas()
    {
        return $this->belongsToMany(Programa::class, 'prestamo_programa', 'prestamo_id', 'programa_id');
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function dependencias()
    {
        return $this->belongsToMany(Dependenciaua::class, 'prestamo_dependencia', 'prestamo_id', 'dependenciaua_id');
    }

}
