<?php
$host = 'localhost';
$db = 'document_manager';
$user = 'root'; // Substitua pelo seu usuário do banco de dados
$pass = ''; // Substitua pela sua senha do banco de dados
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="style.css">