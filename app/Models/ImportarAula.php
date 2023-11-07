<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImportarAula
 *
 * @property $id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ImportarAula extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [];



}
