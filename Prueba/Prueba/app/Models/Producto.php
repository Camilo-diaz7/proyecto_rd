<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $id_producto
 * @property string $nombre
 * @property string $tipo_producto
 * @property int|null $stock
 * @property float $precio_unitario
 * 
 * @property Collection|DetalleVenta[] $detalle_venta
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'producto';
	protected $primaryKey = 'id_producto';
	public $timestamps = false;

	protected $casts = [
		'stock' => 'int',
		'precio_unitario' => 'float'
	];

	protected $fillable = [
		'nombre',
		'tipo_producto',
		'stock',
		'precio_unitario',
		'imagen'
	];

	public function detalle_venta()
	{
		return $this->hasMany(DetalleVenta::class, 'id_producto');
	}
}
