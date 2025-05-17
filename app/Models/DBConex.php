<?php

namespace App\Models;

use PDO;
use PDOException;

class DBConex {
    public static function conectar() {
        try {
            $db = new PDO('mysql:host=localhost;dbname=almacen', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit();
        }
    }
}
