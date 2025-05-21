<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('pedidos')->truncate();
        DB::table('productos')->truncate();
        DB::table('empleados')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insertar empleados
        DB::table('empleados')->insert([
            [
                'nombre' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'telefono' => '123456789',
                'direccion' => 'Calle Falsa 123',
                'puesto' => 'Gerente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana López',
                'email' => 'ana.lopez@example.com',
                'telefono' => '987654321',
                'direccion' => 'Avenida Siempre Viva 456',
                'puesto' => 'Vendedor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insertar productos
        DB::table('productos')->insert([
            [
                'nombre' => 'Laptop',
                'descripcion' => 'Laptop de alta gama',
                'precio' => 1500.00,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mouse',
                'descripcion' => 'Mouse inalámbrico',
                'precio' => 25.00,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insertar usuarios
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'password' => Hash::make('gerente123'),
                'role' => 'Gerente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana López',
                'email' => 'ana.lopez@example.com',
                'password' => Hash::make('vendedor123'),
                'role' => 'Vendedor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Preparar pedidos con control de stock
        $empleadoIds = DB::table('empleados')->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) { // hacemos más intentos por si algunos se saltan por stock
            $producto = DB::table('productos')->inRandomOrder()->first();
            $cantidad = rand(1, 5);

            if ($producto->stock >= $cantidad) {
                $total = $producto->precio * $cantidad;

                // Insertar pedido
                DB::table('pedidos')->insert([
                    'empleado_id' => $empleadoIds[array_rand($empleadoIds)],
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'total' => $total,
                    'created_at' => now()->subDays(rand(0, 30)),
                    'updated_at' => now(),
                ]);

                // Restar stock
                DB::table('productos')
                    ->where('id', $producto->id)
                    ->decrement('stock', $cantidad);
            }
        }
    }
}
