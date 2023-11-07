<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestamop
 *
 * @property $id
 * @property $users_id
 * @property $persona_id
 * @property $perifericosyauxiliares_id
 * @property $fecha_hora_prestamo
 * @property $fecha_hora_entrega
 * @property $observaciones
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Perifericosyauxiliare $perifericosyauxiliare
 * @property Persona $persona
 * @property User $user
 * @property Salon $salon
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prestamop extends Model
{

    protected $table = 'prestamop';

    static $rules = [
		'users_id' => 'required',
		'persona_id' => 'required',
		'perifericosyauxiliares_id' => 'required',
        'salon_id' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id','persona_id','perifericosyauxiliares_id','salon_id','observaciones','fecha_hora_prestamo','fecha_hora_entrega','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function perifericosyauxiliare()
    {
        return $this->hasOne('App\Models\Perifericosyauxiliare', 'id', 'perifericosyauxiliares_id');
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
        return $this->belongsToMany(Programa::class, 'prestamop_programa', 'prestamop_id', 'programa_id');
    }

    public function dependencias()
    {
        return $this->belongsToMany(Dependenciaua::class, 'prestamop_dependencia', 'prestamop_id', 'dependenciaua_id');
    }
}
