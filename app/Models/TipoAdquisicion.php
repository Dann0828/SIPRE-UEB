<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoAdquisicion
 *
 * @property $id
 * @property $tipo_asignacion
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoAdquisicion extends Model
{
    protected $table = 'tipoAdquisicion';
    public $timestamps = false;
    static $rules = [
		'tipo_adquisicion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_adquisicion'];



}