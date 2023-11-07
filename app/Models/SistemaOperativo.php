<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SistemaOperativo
 *
 * @property $id
 * @property $sistema_operativo
 * @property $version
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SistemaOperativo extends Model
{
    protected $table = 'sistemaOperativo';
    public $timestamps = false;
    static $rules = [
		'sistema_operativo' => 'required',
		'version' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sistema_operativo','version'];



}