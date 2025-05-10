<?php
require_once 'config/database.php';

try {
    // Intentar hacer una consulta simple
    $stmt = $pdo->query("SELECT 1");
    echo "¡Conexión exitosa a la base de datos!<br>";
    echo "Host: $host<br>";
    echo "Base de datos: $dbname<br>";
    echo "Usuario: $username<br>";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?> 