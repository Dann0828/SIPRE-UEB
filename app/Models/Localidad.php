<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Localidad
 *
 * @property $id
 * @property $nombreEdificio
 * @property $tipoArea
 * @property $nombreDependencia
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Localidad extends Model
{
    protected $table = 'localidad';
    public $timestamps = false;
    static $rules = [
		'nombreEdificio' => 'required',
		'tipoArea' => 'required',
		'nombreDependencia' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombreEdificio','tipoArea','nombreDependencia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_localidad', 'id');
    }


}
