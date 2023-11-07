<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoPantalla
 *
 * @property $id
 * @property $tipoPantalla
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoPantalla extends Model
{
    protected $table = 'tipoPantalla';
    public $timestamps = false;
    static $rules = [
		'tipoPantalla' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipoPantalla'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_tipo_pantalla', 'id');
    }


}