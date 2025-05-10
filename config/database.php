<?php
$host = getenv('DB_HOST') ?: 'mainline.proxy.rlwy.net';
$dbname = getenv('DB_NAME') ?: 'railway';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'XPxgBOZFnQnMCVvLyDhruxubLBTucnDE';
$port = getenv('DB_PORT') ?: '33034';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?> 