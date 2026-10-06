<?php
session_start();
require "../php/db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

if ($pdo !== null) {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = :id");
    if ($stmt) {
        $stmt->execute([":id" => $id]);
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("Error preparing statement.");
    }
} else {
    die("Database connection failed.");
}
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = :id");
$stmt->execute([":id" => $id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("Blog no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Blog | Abogalia</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="header">
  <div class="logo-container">
    <img src="../assets/Logohorizontal.jpg" class="logo">
  </div>
</header>

<section class="quote">
  <h2>Editar Blog / Noticia</h2>

  <form class="quote-form" action="../php/blogs_update.php" method="POST">

    <input type="hidden" name="id" value="<?= $blog["id"] ?>">

    <input type="text" name="titulo" value="<?= htmlspecialchars($blog["titulo"]) ?>" required>

    <textarea name="descripcion" required><?= htmlspecialchars($blog["descripcion"]) ?></textarea>

    <input type="text" name="enlace" value="<?= htmlspecialchars($blog["enlace"]) ?>" required>

    <button type="submit" class="btn-primary">Actualizar</button>
    <a href="blogs_list.php" class="btn-secondary">Volver</a>
  </form>
</section>

</body>
</html>