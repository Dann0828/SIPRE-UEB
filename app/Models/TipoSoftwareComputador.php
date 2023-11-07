<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoSoftwareComputador
 *
 * @property $id
 * @property $tipoSoftware
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoSoftwareComputador extends Model
{
    protected $table = 'tipoSoftwareComputador';
    public $timestamps = false;
    static $rules = [
		'tipoSoftware' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipoSoftware'];



}