<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpia las tablas
        DB::table('pedidos')->truncate();
        DB::table('productos')->truncate();
        DB::table('empleados')->truncate();
        DB::table('users')->truncate();

        // Reactivar restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Llenar la tabla de empleados
        DB::table('empleados')->insert([
            [
                'nombre' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'telefono' => '123456789',
                'direccion' => 'Calle Falsa 123',
                'puesto' => 'Gerente', // Rol Gerente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana López',
                'email' => 'ana.lopez@example.com',
                'telefono' => '987654321',
                'direccion' => 'Avenida Siempre Viva 456',
                'puesto' => 'Vendedor', // Rol Vendedor
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Llenar la tabla de productos
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

        // Llenar la tabla de pedidos
        DB::table('pedidos')->insert([
            [
                'empleado_id' => 1, // ID del empleado Juan Pérez
                'producto_id' => 1, // ID del producto Laptop
                'cantidad' => 2,
                'total' => 3000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'empleado_id' => 2, // ID del empleado Ana López
                'producto_id' => 2, // ID del producto Mouse
                'cantidad' => 5,
                'total' => 125.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Llenar la tabla de usuarios con roles actualizados
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'), // Contraseña para Admin
                'role' => 'Admin', // Rol actualizado a Admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'password' => Hash::make('gerente123'), // Contraseña para Gerente
                'role' => 'Gerente', // Rol actualizado a Gerente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana López',
                'email' => 'ana.lopez@example.com',
                'password' => Hash::make('vendedor123'), // Contraseña para Vendedor
                'role' => 'Vendedor', // Rol actualizado a Vendedor
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
