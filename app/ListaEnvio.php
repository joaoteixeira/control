<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaEnvio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lista_envio';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'dados', 'enviado'];
}
