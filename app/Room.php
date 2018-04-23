<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numero', 'descricao', 'agendavel', 'campi_id'];

    public function campus()
    {
        return $this->belongsTo('App\Campi');
    }
    
}
