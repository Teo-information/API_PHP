-- Crear la base de datos con charset y collation recomendados
CREATE DATABASE IF NOT EXISTS sistema_notas
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE sistema_notas;

-- Crear la tabla de notas con restricciones adicionales
CREATE TABLE IF NOT EXISTS notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_alumno VARCHAR(100) NOT NULL,
    materia VARCHAR(100) NOT NULL,
    nota DECIMAL(5,2) NOT NULL CHECK (nota >= 0 AND nota <= 100),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;