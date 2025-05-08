<?php

// Ruta del archivo donde se guardará la salida
$outputFile = 'c:/Users/LemOwO/carmonaStorage/almacen/pruebasTinker/test_results.txt';

// Abre el archivo en modo escritura
$file = fopen($outputFile, 'w');

// Función para escribir en el archivo
function logToFile($file, $message) {
    fwrite($file, $message . PHP_EOL);
}

// Escribe el encabezado
logToFile($file, "=== Resultados de las pruebas ===\n");

// Crea el usuario admin
logToFile($file, "Creando usuario admin...");
ob_start();
include 'create_admin_user.php';
logToFile($file, ob_get_clean());

// Ejecuta las demás pruebas y guarda los resultados
logToFile($file, "Ejecutando prueba de roles...");
ob_start();
include 'test_roles.php';
logToFile($file, ob_get_clean());

logToFile($file, "Ejecutando prueba de roles para todos los usuarios...");
ob_start();
include 'test_roles_all.php';
logToFile($file, ob_get_clean());

logToFile($file, "Ejecutando prueba de autenticación con tokens...");
ob_start();
include 'test_tokens.php';
logToFile($file, ob_get_clean());

logToFile($file, "Ejecutando prueba de cierre de sesión...");
ob_start();
include 'test_logout.php';
logToFile($file, ob_get_clean());

logToFile($file, "Ejecutando prueba de validaciones en el registro...");
ob_start();
include 'test_register_validation.php';
logToFile($file, ob_get_clean());

logToFile($file, "Ejecutando prueba de eliminación de usuarios...");
ob_start();
include 'test_delete_user.php';
logToFile($file, ob_get_clean());

logToFile($file, "Ejecutando prueba de actualización de usuarios...");
ob_start();
include 'test_update_user.php';
logToFile($file, ob_get_clean());

// Escribe el pie de página
logToFile($file, "=== Fin de las pruebas ===");

// Cierra el archivo
fclose($file);

echo "Todas las pruebas se han ejecutado. Los resultados se han guardado en: $outputFile\n";
