<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['empleado_id', 'producto_id', 'cantidad', 'total'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
