<?php
require_once 'config/database.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS notas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_alumno VARCHAR(100) NOT NULL,
        materia VARCHAR(100) NOT NULL,
        nota DECIMAL(5,2) NOT NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "¡Tabla 'notas' creada exitosamente!";
} catch(PDOException $e) {
    echo "Error al crear la tabla: " . $e->getMessage();
}
?> 