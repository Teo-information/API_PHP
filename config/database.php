<?php
$config = require_once 'config.php';

$host = $config['db']['host'];
$dbname = $config['db']['name'];
$username = $config['db']['user'];
$password = $config['db']['pass'];
$port = $config['db']['port'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?> 