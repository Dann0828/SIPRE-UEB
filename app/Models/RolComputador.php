<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolComputador
 *
 * @property $id
 * @property $rol
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RolComputador extends Model
{
    protected $table = 'rolComputador';
    public $timestamps = false;
    static $rules = [
		'rol' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rol'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_usuarios', 'id');
    }


}