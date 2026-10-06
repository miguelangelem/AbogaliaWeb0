<?php
session_start();
require "../php/db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: login.php");
    exit();
}

$abogado_id = $_SESSION["abogado_id"];

$stmt = $pdo?->prepare("SELECT * FROM abogados WHERE id = :id");
$stmt?->execute([":id" => $abogado_id]);
$abogado = $stmt?->fetch(PDO::FETCH_ASSOC);

if (!$abogado || $abogado === null) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Abogado | Abogalia</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="header">
  <div class="logo-container">
    <img src="../assets/Logohorizontal.jpg" class="logo">
  </div>

  <nav class="nav">
    <ul class="nav-links show">
      <li><a href="../index.php">Inicio</a></li>
      <li><a href="panel.php">Panel</a></li>
      <li><a href="../php/logout.php">Cerrar Sesión</a></li>
    </ul>
  </nav>
</header>

<section class="filters">
  <h2>Bienvenido, <?= htmlspecialchars($_SESSION["abogado_nombre"]) ?></h2>

  <div class="lawyer-card">
    <p><strong>Especialización:</strong> <?= htmlspecialchars($abogado["especializacion"]) ?></p>
    <p><strong>Ciudad:</strong> <?= htmlspecialchars($abogado["ciudad"]) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($abogado["email"]) ?></p>

    <a href="abogado_profile.php?id=<?= $abogado_id ?>" class="btn-secondary">Ver Perfil Público</a>
    <a href="abogado_edit.php?id=<?= $abogado_id ?>" class="btn-primary">Editar Perfil</a>
    <a href="citas_list.php?abogado_id=<?= $abogado_id ?>" class="btn-primary">Ver Citas</a>
    <a href="blogs_list.php" class="btn-secondary">Administrar Blogs</a>
  </div>

</section>

</body>
</html>