<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Programa
 *
 * @property $id
 * @property $nombre
 * @property $facultad_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Facultad $facultad
 * @property Persona[] $personas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Programa extends Model
{

    protected $table = 'programa';

    static $rules = [
		'nombre' => 'required',
		'facultad_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','facultad_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function facultad()
    {
        return $this->hasOne('App\Models\Facultad', 'id', 'facultad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'persona_programa', 'programa_id', 'persona_id');
    }    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function prestamos()
    {
        return $this->belongsToMany(Prestamo::class, 'prestamo_programa', 'programa_id', 'prestamo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function prestamops()
    {
        return $this->belongsToMany(Prestamop::class, 'prestamop_programa', 'programa_id', 'prestamop_id');
    }

}