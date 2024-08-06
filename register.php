<?php
session_start();
require 'config.php';
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        echo "<span class="sucess">Registro bem-sucedido! <a href='login.php'>Faça login</a></span>";
    } else {
        echo "<span>Erro ao registrar.</span>";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuário</h2>
    <form method="post">
        <label>Nome de usuário:</label>
        <input type="text" name="username" required><br>
        <label>Senha:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>