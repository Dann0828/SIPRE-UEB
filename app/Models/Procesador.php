<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Procesador
 *
 * @property $id
 * @property $referencia
 * @property $frecuencia
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Procesador extends Model
{
    protected $table = 'procesador';
    public $timestamps = false;
    static $rules = [
		'referencia' => 'required',
		'frecuencia' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['referencia','frecuencia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_procesador', 'id');
    }


}
