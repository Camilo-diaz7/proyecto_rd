<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    public $timestamps = false;
    protected $table = 'boleta'; 
    protected $primaryKey = 'id_boleta';
    protected $fillable = ['id_evento', 'id_usuario', 'cantidad_boletos'];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }

    public function user()
    {
       return $this->belongsTo(User::class, 'id_usuario', 'id'); 
    }
}
	