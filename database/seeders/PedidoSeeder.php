<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Producto;
use Carbon\Carbon;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            // Obtener un producto aleatorio
            $producto = Producto::inRandomOrder()->first();
            $cantidad = rand(1, 5); // entre 1 y 5 unidades

            Pedido::create([
                'empleado_id'  => rand(1, 5),
                'producto_id'  => $producto->id,
                'cantidad'     => $cantidad,
                'total'        => $producto->precio * $cantidad,
                'created_at'   => Carbon::now()->subDays(rand(0, 30)), // fechas recientes
                'updated_at'   => Carbon::now(),
            ]);
        }
    }
}
