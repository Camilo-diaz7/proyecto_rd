<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ventum
 * 
 * @property int $id_venta
 * @property Carbon $fecha
 * @property float $total
 * @property string $metodo_pago
 * @property int|null $id
 * 
 * @property User|null $usuario
 * @property Collection|DetalleVenta[] $detalle_venta
 *
 * @package App\Models
 */
class Venta extends Model
{
    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;

    protected $casts = [
        'fecha' => 'datetime',
        'total' => 'float',
        'id' => 'int'   // ID del usuario que realizó la venta
    ];

    protected $fillable = [
        'fecha',
        'total',
        'metodo_pago',
        'id'  // ID del usuario que realizó la venta
    ];

    public function usuario()
    {
        // belongsTo(Model, foreign_key_en_venta, primary_key_en_user)
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function detalle_venta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }

    /**
     * Calcula el total de la venta basado en los detalles
     */
    public function calcularTotal()
    {
        return $this->detalle_venta->sum(function ($detalle) {
            return $detalle->precio_unitario * $detalle->cantidad_productos;
        });
    }

    /**
     * Actualiza el total de la venta automáticamente
     */
    public function actualizarTotal()
    {
        $this->total = $this->calcularTotal();
        $this->save();
        return $this->total;
    }

    /**
     * Accessor para el total calculado
     */
    public function getTotalCalculadoAttribute()
    {
        return $this->calcularTotal();
    }
}
