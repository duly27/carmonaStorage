<?php

namespace App\Models;

use Illuminate\Http\Request;
use PDO;


class EmpleadoDB
{
    private $db;

    public function __construct()
    {
        // Establecemos la conexión a la base de datos
        $this->db = DBConex::conectar();
    }

    /**
     * Obtener todos los empleados de la base de datos
     *
     * @return array
     */
    public function obtenerEmpleados()
    {
        // Consulta SQL para obtener los empleados
        $sql = "SELECT id, nombre, email, telefono, direccion, puesto, created_at, updated_at FROM empleados";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $empleados = [];

        // Recorremos los resultados y creamos instancias de la clase Empleado
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $empleados[] = new Empleado([
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'email' => $row['email'],
                'telefono' => $row['telefono'],
                'direccion' => $row['direccion'],
                'puesto' => $row['puesto'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
            ]);
        }

        return $empleados;
    }

    /**
     * Crear un nuevo empleado en la base de datos y registrarlo en la tabla users
     *
     * @param Empleado $empleado
     * @return bool
     */
    public function crearEmpleado(Empleado $empleado)
    {
        try {
            // Iniciamos una transacción para asegurar consistencia
            $this->db->beginTransaction();

            // Consulta SQL para insertar un nuevo empleado
            $sqlEmpleado = "INSERT INTO empleados (nombre, email, telefono, direccion, puesto)
                            VALUES (:nombre, :email, :telefono, :direccion, :puesto)";
            $stmtEmpleado = $this->db->prepare($sqlEmpleado);

            // Asignamos los parámetros con los valores de la clase Empleado
            $nombre = $empleado->getNombre();
            $email = $empleado->getEmail();
            $telefono = $empleado->getTelefono();
            $direccion = $empleado->getDireccion();
            $puesto = $empleado->getPuesto();

            $stmtEmpleado->bindParam(':nombre', $nombre);
            $stmtEmpleado->bindParam(':email', $email);
            $stmtEmpleado->bindParam(':telefono', $telefono);
            $stmtEmpleado->bindParam(':direccion', $direccion);
            $stmtEmpleado->bindParam(':puesto', $puesto);

            // Ejecutamos la inserción en la tabla empleados
            $stmtEmpleado->execute();

            // Consulta SQL para insertar en la tabla users
            $sqlUser = "INSERT INTO users (email, password, role)
                        VALUES (:email, :password, :role)";
            $stmtUser = $this->db->prepare($sqlUser);

            // Generamos una contraseña por defecto y asignamos a variables
            $password = password_hash('default_password', PASSWORD_BCRYPT); // Variable para la contraseña
            $role = 'empleado'; // Variable para el rol

            $stmtUser->bindParam(':email', $email); // Reutilizamos la variable $email
            $stmtUser->bindParam(':password', $password); // Usamos la variable $password
            $stmtUser->bindParam(':role', $role); // Usamos la variable $role

            // Ejecutamos la inserción en la tabla users
            $stmtUser->execute();

            // Confirmamos la transacción
            $this->db->commit();

            return true;
        } catch (\Exception $e) {
            // En caso de error, revertimos la transacción
            $this->db->rollBack();
            throw $e;
        }
    }

    /**
     * Eliminar un empleado de la base de datos por su ID
     *
     * @param int $id
     * @return bool
     */
    public function eliminarEmpleado(Request $request)
    {
        // Obtenemos el ID del empleado desde la solicitud
        $id = $request->input('id');

        //Consulta SQL para eliminar un empleado
        $empleado = Empleado::find($id);
        if ($empleado) {
            // Eliminar el empleado
            $empleado->delete();
            return true;
        }
        return false;
    }

    /**
     * Eliminar un empleado de la base de datos por su ID y eliminar el usuario relacionado en la tabla users
     *
     * @param int $id
     * @return bool
     */
    public function eliminarEmpleadoPorId($id)
    {
        // Eliminar de la tabla users primero
        $empleado = Empleado::find($id);
        if ($empleado) {
            // Elimina el usuario relacionado en la tabla users
            $sql = "DELETE FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $email = $empleado->email;
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Elimina el empleado
            $empleado->delete();
            return true;
        }
        return false;
    }

    /**
     * Obtener un solo empleado por su ID
     *
     * @param int $id
     * @return Empleado|null
     */
    public function obtenerEmpleadoPorId($id)
    {
        // Consulta SQL para obtener un empleado por su ID
        $sql = "SELECT id, nombre, email, telefono, direccion, puesto, created_at, updated_at FROM empleados WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Verificamos si existe un resultado
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Creamos una nueva instancia de Empleado y la retornamos
            return new Empleado(
                $row['id'],
                $row['nombre'],
                $row['email'],
                $row['telefono'],
                $row['direccion'],
                $row['puesto'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return null;
    }

    /**
     * Actualizar un empleado en la base de datos
     *
     * @param Empleado $empleado
     * @return bool
     */
//     public function actualizarEmpleado(Empleado $empleado)
//     {
//         // Consulta SQL para actualizar los datos del empleado
//         $sql = "UPDATE empleados SET
//                 nombre = :nombre,
//                 email = :email,
//                 telefono = :telefono,
//                 direccion = :direccion,
//                 puesto = :puesto
//                 WHERE id = :id";

//         // Preparamos la sentencia
//         $stmt = $this->db->prepare($sql);

//         // Asignamos los parámetros con los valores de la clase Empleado
//         $stmt->bindParam(':nombre', $empleado->getNombre());
//         $stmt->bindParam(':email', $empleado->getEmail());
//         $stmt->bindParam(':telefono', $empleado->getTelefono());
//         $stmt->bindParam(':direccion', $empleado->getDireccion());
//         $stmt->bindParam(':puesto', $empleado->getPuesto());
//         $stmt->bindParam(':id', $empleado->getId(), PDO::PARAM_INT);

//         // Ejecutamos la sentencia y retornamos el resultado (true o false)
//         return $stmt->execute();
//     }
}
