<?php
session_start();
require 'config.php';
 
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
 
$user_id = $_SESSION['user_id'];
 
// Obter o nome de usuário
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Obter os documentos do usuário
$stmt = $pdo->prepare("SELECT * FROM documents WHERE user_id = ?");
$stmt->execute([$user_id]);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Meus Documentos</title>
</head>    
<body>
    <header>
        <h1>Document Manager</h1>
    </header>
    <div class="container">
        <h2>Meus Documentos</h2>
        <?php if ($user): ?>
            <div class="welcome-message">
                Bem-vindo, <?php echo htmlspecialchars($user['username']); ?>!
            </div>
        <?php endif; ?>
        <ul>
            <?php foreach ($documents as $doc): ?>
                <li>
                    <a href="uploads/<?php echo htmlspecialchars($doc['file_name']); ?>" target="_blank">
                        <?php echo htmlspecialchars($doc['file_name']); ?>
                    </a> - Enviado em <?php echo htmlspecialchars($doc['upload_date']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="links">
            <a href="upload.php">Enviar Novo Documento</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
</body>
</html>
 