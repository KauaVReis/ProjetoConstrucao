<?php
$host = 'localhost';
$dbname = 'saep_db2'; // <--- VERIFIQUE SE MUDOU AQUI
$username = 'root';
$password = ''; // ou sua senha

try {
     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
     die("Erro de conexão: " . $e->getMessage());
}
?>