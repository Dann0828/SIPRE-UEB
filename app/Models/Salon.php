<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Salon
 *
 * @property $id
 * @property $descripcion
 * @property $edificio_id
 * @property $tipoaula_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Edificio $edificio
 * @property Prestamo[] $prestamos
 * @property Prestamop[] $prestamops
 * @property Tipoaula $tipoaula
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Salon extends Model
{
    protected $table = 'salon';


    static $rules = [
		'edificio_id' => 'required',
		'tipoaula_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','edificio_id','tipoaula_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function edificio()
    {
        return $this->hasOne('App\Models\Edificio', 'id', 'edificio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Models\Prestamo', 'salon_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamops()
    {
        return $this->hasMany('App\Models\Prestamop', 'salon_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoaula()
    {
        return $this->hasOne('App\Models\Tipoaula', 'id', 'tipoaula_id');
    }


}
