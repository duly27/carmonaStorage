<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    /**
     * Mostrar listado de empleados
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados', compact('empleados'));
    }

    /**
     * Mostrar formulario para crear nuevo empleado
     */
    public function create()
    {
        return view('alta_empleado');
    }

    /**
     * Almacenar nuevo empleado y crear usuario relacionado
     */
    public function store(Request $request)
    {
        // Validar datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'puesto' => 'required|string|max:100',
        ]);

        // Usar transacción para asegurar que ambas operaciones se ejecuten correctamente o ninguna
        DB::beginTransaction();
        try {
            // Crear nuevo empleado en tabla empleados
            $empleado = Empleado::create($request->only('nombre', 'email', 'telefono', 'direccion', 'puesto'));

            // Crear usuario relacionado en tabla users
            // La contraseña será el puesto + '123', hasheada para seguridad
            User::create([
                'name' => $request->input('nombre'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('puesto') . '123'),
                'role' => $request->input('puesto'),
            ]);

            DB::commit(); // Confirmar transacción

            return redirect()->route('empleados.index')->with('success', 'Empleado y usuario creados exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios en caso de error
            return redirect()->route('empleados.index')->with('error', 'Error al crear empleado y usuario.');
        }
    }

    /**
     * Eliminar empleado y usuario relacionado
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Buscar empleado por id
            $empleado = Empleado::findOrFail($id);

            // Eliminar usuario relacionado basado en email del empleado
            DB::table('users')->where('email', $empleado->email)->delete();

            // Eliminar registro del empleado
            $empleado->delete();

            DB::commit();

            return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('empleados.index')->with('error', 'Error al eliminar el empleado.');
        }
    }

    /**
     * Mostrar formulario para editar empleado
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('editar_empleado', compact('empleado'));
    }

    /**
     * Actualizar datos del empleado y del usuario relacionado
     */
    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:empleados,email,' . $id,
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'puesto' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            // Buscar empleado por id
            $empleado = Empleado::findOrFail($id);

            // Guardar el email original para buscar usuario en tabla users
            $emailOriginal = $empleado->email;

            // Actualizar datos del empleado
            $empleado->update($request->only('nombre', 'email', 'telefono', 'direccion', 'puesto'));

            // Buscar usuario relacionado por email original
            $usuario = User::where('email', $emailOriginal)->first();

            if ($usuario) {
                // Actualizar nombre, email y rol
                $usuario->name = $request->input('nombre');
                $usuario->email = $request->input('email');
                $usuario->role = $request->input('puesto');

                // Actualizar contraseña a nuevo puesto + '123'
                $usuario->password = Hash::make($request->input('puesto') . '123');

                $usuario->save();
            }

            DB::commit();

            return redirect()->route('empleados.index')->with('success', 'Empleado y usuario actualizados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('empleados.index')->with('error', 'Error al actualizar empleado.');
        }
    }
}
