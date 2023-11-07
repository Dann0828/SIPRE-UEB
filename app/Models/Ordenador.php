<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordenador
 *
 * @property $id
 * @property $marca
 * @property $modelo
 * @property $id_tipoComputador
 * @property $id_tipoAdquisicion
 * @property $id_slotsRam
 * @property $serie
 * @property $valor
 * @property $fecha_compra
 * @property $fecha_vencimiento_garantia
 * @property $placa_inventario
 * @property $perifericos_adicionales
 * @property $id_sistemaoperativo
 * @property $marca_pantalla
 * @property $modelo_pantalla
 * @property $serial_pantalla
 * @property $pulgadas
 * @property $id_tipo_pantalla
 * @property $id_procesador
 * @property $espacio_disco_duro
 * @property $id_tipo_discoDuro
 * @property $id_modeloRam
 * @property $espacioRam
 * @property $fecha_asignacion
 * @property $id_tipoAsignacion
 * @property $id_estado
 * @property $id_localidad
 * @property $id_usuarios
 * @property $nombreRed
 * @property $usuarioDominio
 * @property $observaciones
 * @property $direccionMacL
 * @property $direccionMacW
 * @property $descripcionDiscoDuro
 * @property $softwareLicenciado
 * @property $softwareLibre
 * @property $usuario
 * @property $cargo
 * @property $extension
 * @property $correoInstitucional
 *
 * @property Estadocomputador $estadocomputador
 * @property Hojavidaordenador[] $hojavidaordenadors
 * @property Localidad $localidad
 * @property MantenimientoOrdenador[] $mantenimientoOrdenadors
 * @property Prestamo[] $prestamos
 * @property Procesador $procesador
 * @property Rolcomputador $rolcomputador
 * @property Sistemaoperativo $sistemaoperativo
 * @property Slotsram $slotsram
 * @property Tipoadquisicion $tipoadquisicion
 * @property Tipoasignacionlocalidad $tipoasignacionlocalidad
 * @property Tipocomputador $tipocomputador
 * @property Tipodiscoduro $tipodiscoduro
 * @property Tipopantalla $tipopantalla
 * @property Tiporam $tiporam
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ordenador extends Model
{
    protected $table = 'ordenador';
    public $timestamps = false;
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['marca','modelo','id_tipoComputador','id_tipoAdquisicion','id_slotsRam','serie','valor','fecha_compra','fecha_vencimiento_garantia','placa_inventario','perifericos_adicionales','id_sistemaoperativo','marca_pantalla','modelo_pantalla','serial_pantalla','pulgadas','id_tipo_pantalla','id_procesador','espacio_disco_duro','id_tipo_discoDuro','id_modeloRam','espacioRam','fecha_asignacion','id_tipoAsignacion','id_estado','id_localidad','id_usuarios','nombreRed','usuarioDominio','observaciones','direccionMacL','direccionMacW','descripcionDiscoDuro','softwareLicenciado','softwareLibre','usuario','cargo','extension','correoInstitucional'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estadocomputador()
    {
        return $this->hasOne('App\Models\EstadoComputador', 'id', 'id_estado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hojavidaordenadors()
    {
        return $this->hasMany('App\Models\Hojavidaordenador', 'ordenador_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localidad()
    {
        return $this->hasOne('App\Models\Localidad', 'id', 'id_localidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mantenimientoOrdenadors()
    {
        return $this->hasMany('App\Models\MantenimientoOrdenador', 'ordenador_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Models\Prestamo', 'equipo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function procesador()
    {
        return $this->hasOne('App\Models\Procesador', 'id', 'id_procesador');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rolcomputador()
    {
        return $this->hasOne('App\Models\RolComputador', 'id', 'id_usuarios');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sistemaoperativo()
    {
        return $this->hasOne('App\Models\SistemaOperativo', 'id', 'id_sistemaoperativo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function slotsram()
    {
        return $this->hasOne('App\Models\SlotsRam', 'id', 'id_slotsRam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoadquisicion()
    {
        return $this->hasOne('App\Models\TipoAdquisicion', 'id', 'id_tipoAdquisicion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoasignacionlocalidad()
    {
        return $this->hasOne('App\Models\TipoAsignacionLocalidad', 'id', 'id_tipoAsignacion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipocomputador()
    {
        return $this->hasOne('App\Models\TipoComputador', 'id', 'id_tipoComputador');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipodiscoduro()
    {
        return $this->hasOne('App\Models\TipoDiscoDuro', 'id', 'id_tipo_discoDuro');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipopantalla()
    {
        return $this->hasOne('App\Models\TipoPantalla', 'id', 'id_tipo_pantalla');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tiporam()
    {
        return $this->hasOne('App\Models\TipoRam', 'id', 'id_modeloRam');
    }


}