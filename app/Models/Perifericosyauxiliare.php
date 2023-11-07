<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Perifericosyauxiliare
 *
 * @property $id
 * @property $marca_pa
 * @property $modelo_pa
 * @property $id_tipoaux
 * @property $valor
 * @property $id_estado
 * @property $id_localidad
 * @property $fecha_compra
 * @property $fecha_ven_garantia
 *
 * @property Estadocomputador $estadocomputador
 * @property Localidad $localidad
 * @property Tipoaux $tipoaux
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Perifericosyauxiliare extends Model
{
    protected $table = 'perifericosyauxiliares';
    public $timestamps = false;
    static $rules = [
		'marca_pa' => 'required',
		'modelo_pa' => 'required',
		'id_tipoaux' => 'required',
		'valor' => 'required',
        'id_estado' => 'required',
        'id_localidad' => 'required',
		'fecha_compra' => 'required',
		'fecha_ven_garantia' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['marca_pa','modelo_pa','id_tipoaux','valor','id_estado','id_localidad','fecha_compra','fecha_ven_garantia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estadocomputador()
    {
        return $this->hasOne('App\Models\EstadoComputador', 'id', 'id_estado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localidad()
    {
        return $this->hasOne('App\Models\Localidad', 'id', 'id_localidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoaux()
    {
        return $this->hasOne('App\Models\Tipoaux', 'id', 'id_tipoaux');
    }


}