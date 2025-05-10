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
        $stmt = $pdo->prepare("INSERT INTO notas (nombre_alumno, materia, nota) VALUES (?, ?, ?)");
        $stmt->execute([$data['nombre_alumno'], $data['materia'], $data['nota']]);
        echo json_encode(['message' => 'Nota registrada exitosamente']);
        break;

    case 'PUT':
        // Actualizar nota
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE notas SET nombre_alumno = ?, materia = ?, nota = ? WHERE id = ?");
        $stmt->execute([$data['nombre_alumno'], $data['materia'], $data['nota'], $data['id']]);
        echo json_encode(['message' => 'Nota actualizada exitosamente']);
        break;

    case 'DELETE':
        // Eliminar nota
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM notas WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Nota eliminada exitosamente']);
        break;
}
?> 