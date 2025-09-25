<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleVentum
 * 
 * @property int $id_detalleV
 * @property int|null $id_venta
 * @property int|null $id_producto
 * @property string|null $descripcion
 * @property int $cantidad_productos
 * @property float $precio_unitario
 * 
 * @property Venta|null $venta
 * @property Producto|null $producto
 *
 * @package App\Models
 */
class DetalleVenta extends Model
{
	protected $table = 'detalle_venta';
	protected $primaryKey = 'id_detalleV';
	public $timestamps = false;

	protected $casts = [
		'id_venta' => 'int',
		'id_producto' => 'int',
		'cantidad_productos' => 'int',
		'precio_unitario' => 'float'
	];

	protected $fillable = [
		'id_venta',
		'id_producto',
		'descripcion',
		'cantidad_productos',
		'precio_unitario'
	];

	public function venta()
	{
		return $this->belongsTo(Venta::class, 'id_venta');
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'id_producto');
	}

	/**
	 * Eventos del modelo para actualizar automáticamente el total de la venta
	 */
	protected static function boot()
	{
		parent::boot();

		static::created(function ($detalleVenta) {
			if ($detalleVenta->venta) {
				$detalleVenta->venta->actualizarTotal();
			}
		});

		static::updated(function ($detalleVenta) {
			if ($detalleVenta->venta) {
				$detalleVenta->venta->actualizarTotal();
			}
		});

		static::deleted(function ($detalleVenta) {
			if ($detalleVenta->venta) {
				$detalleVenta->venta->actualizarTotal();
			}
		});
	}

	/**
	 * Calcula el subtotal de este detalle
	 */
	public function getSubtotalAttribute()
	{
		return $this->precio_unitario * $this->cantidad_productos;
	}
}
