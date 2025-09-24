<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservacion
 * 
 * @property int $id_reservacion
 * @property int|null $id_usuario
 * @property int $cantidad_personas
 * @property int $cantidad_mesas
 * @property Carbon $fecha_reservacion
 * @property string|null $ocasion
 * 
 * @property User|null $usuario
 *
 * @package App\Models
 */
class Reservacion extends Model
{
	protected $table = 'reservacion';
	protected $primaryKey = 'id_reservacion';
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'cantidad_personas' => 'int',
		'cantidad_mesas' => 'int',
		'fecha_reservacion' => 'datetime'
	];

	protected $fillable = [
		'id',
		'cantidad_personas',
		'cantidad_mesas',
		'fecha_reservacion',
		'ocasion'
	];
public function getRouteKeyName()
{
    return 'id_reservacion';
}
	public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
