<?php
session_start();
require 'config.php';
 
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['document'])) {
    $user_id = $_SESSION['user_id'];
    $file = $_FILES['document'];
    $file_name = basename($file['name']);
    $target_file = 'uploads/' . $file_name;
 
    if ($file['type'] == 'application/pdf' && move_uploaded_file($file['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO documents (user_id, file_name) VALUES (?, ?)");
        if ($stmt->execute([$user_id, $file_name])) {
            echo "Documento enviado com sucesso!";
        } else {
            echo "<span>Erro ao salvar documento no banco de dados.</span>";
        }
    } else {
        echo "O arquivo deve ser um PDF.";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Upload de Documento</title>
</head>
<body>
    <h2>Upload de Documento</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Escolha o arquivo PDF:</label>
        <input type="file" name="document" accept=".pdf" required><br>
        <input type="submit" value="Enviar">
    </form>
    <a href="logout.php">Sair</a>
</body>
</html>
 