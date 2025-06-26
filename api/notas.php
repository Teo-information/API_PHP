<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Listar notas
        $stmt = $pdo->query("SELECT * FROM notas");
        $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($notas);
        break;

    case 'POST':
        // Registrar nueva nota
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validar datos
        if (!isset($data['nombre_alumno']) || !isset($data['materia']) || !isset($data['nota'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos requeridos']);
            break;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO notas (nombre_alumno, materia, nota) VALUES (?, ?, ?)");
            $stmt->execute([$data['nombre_alumno'], $data['materia'], $data['nota']]);
            echo json_encode(['message' => 'Nota registrada exitosamente']);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al registrar la nota: ' . $e->getMessage()]);
        }
        break;

    case 'PUT':
        // Actualizar nota
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validar datos
        if (!isset($data['id']) || !isset($data['nombre_alumno']) || !isset($data['materia']) || !isset($data['nota'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos requeridos']);
            break;
        }

        try {
            $stmt = $pdo->prepare("UPDATE notas SET nombre_alumno = ?, materia = ?, nota = ? WHERE id = ?");
            $stmt->execute([$data['nombre_alumno'], $data['materia'], $data['nota'], $data['id']]);
            echo json_encode(['message' => 'Nota actualizada exitosamente']);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la nota: ' . $e->getMessage()]);
        }
        break;

    case 'DELETE':
        // Eliminar nota
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            break;
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM notas WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['message' => 'Nota eliminada exitosamente']);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la nota: ' . $e->getMessage()]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?> 