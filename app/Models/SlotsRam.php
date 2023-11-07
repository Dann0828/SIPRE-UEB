<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SlotsRam
 *
 * @property $id
 * @property $slotsRam
 * @property $descripcion
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SlotsRam extends Model
{
    protected $table = 'slotsRam';
    public $timestamps = false;
    static $rules = [
		'slotsRam' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['slotsRam','descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_slotsRam', 'id');
    }


}