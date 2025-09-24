<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evento
 *
 * @property int $id_evento
 * @property string $nombre_evento
 * @property int $capacidad_maxima
 * @property string|null $descripcion
 * @property Carbon $fecha
 * @property Carbon $hora_inicio
 *
 * @property Collection|Boleta[] $boleta
 *
 * @package App\Models
 */
class Evento extends Model
{
	protected $table = 'evento';
	protected $primaryKey = 'id_evento';
	public $timestamps = false;

	protected $casts = [
		'capacidad_maxima' => 'int',
		'fecha' => 'datetime',
		'hora_inicio' => 'datetime'
	];

	protected $fillable = [
    'nombre_evento',
    'capacidad_maxima',
    'descripcion',
    'fecha',
    'hora_inicio',
    'precio_boleta',
	'imagen',
];

	public function boleta()
	{
		return $this->hasMany(Boleta::class, 'id_evento');
	}
}
