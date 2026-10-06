<?php
session_start();
require "../php/db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: login.php");
    exit();
}

if ($pdo !== null) {
    $stmt = $pdo->prepare("SELECT * FROM blogs ORDER BY created_at DESC");
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $blogs = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrar Blogs | Abogalia</title>
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
      <li><a href="../php/logout.php">Cerrar sesión</a></li>
    </ul>
  </nav>
</header>

<section class="filters">
  <h2>Administración de Blogs</h2>
  <p>Aquí puedes crear, editar o eliminar enlaces de noticias legales.</p>

  <a href="blogs_create.php" class="btn-primary">Agregar nuevo blog</a>

  <?php if(count($blogs) == 0): ?>
    <p style="margin-top:20px;">No hay blogs registrados.</p>
  <?php endif; ?>

  <?php foreach($blogs as $blog): ?>
    <div class="lawyer-card" style="margin-top:20px;">
      <h3><?= htmlspecialchars($blog["titulo"]) ?></h3>
      <p><?= htmlspecialchars($blog["descripcion"]) ?></p>
      <p style="margin-top:10px;">
        <a href="<?= htmlspecialchars($blog["enlace"]) ?>" target="_blank" class="btn-secondary">
          Ver enlace
        </a>
      </p>

      <div style="margin-top:15px; display:flex; gap:12px; flex-wrap:wrap;">
        <a href="blogs_edit.php?id=<?= $blog["id"] ?>" class="btn-primary">Editar</a>

        <form action="../php/blogs_delete.php" method="POST">
          <input type="hidden" name="id" value="<?= $blog["id"] ?>">
          <button type="submit" class="btn-secondary">Eliminar</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>

  <br>
  <a href="panel.php" class="btn-secondary">Volver al panel</a>
</section>

</body>
</html>