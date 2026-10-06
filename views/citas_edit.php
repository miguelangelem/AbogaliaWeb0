<?php
session_start();
require "../php/db.php";

if (!isset($pdo) || !$pdo instanceof PDO) {
    die("Error de conexión con la base de datos.");
}

if (!isset($_SESSION["abogado_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];
$abogado_id = $_GET["abogado_id"];

// Seguridad: solo el dueño puede editar sus citas
if ($_SESSION["abogado_id"] != $abogado_id) {
    die("Acceso denegado.");
}

// Obtener cita
$stmt = $pdo->prepare("SELECT * FROM citas WHERE id = :id AND abogado_id = :abogado_id");
if (!$stmt) {
    die("Error preparing statement.");
}
$stmt->execute([
    ":id" => $id,
    ":abogado_id" => $abogado_id
]);
$cita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cita) {
    die("Cita no encontrada.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Cita | Abogalia</title>
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

<section class="quote">
  <h2>Actualizar Estado de Cita</h2>
  <p>Modifica el estado de la cita para llevar un control de solicitudes.</p>

  <form class="quote-form" action="../php/citas_update.php" method="POST">

    <input type="hidden" name="id" value="<?= $cita["id"] ?>">
    <input type="hidden" name="abogado_id" value="<?= $abogado_id ?>">

    <p><strong>Cliente:</strong> <?= htmlspecialchars($cita["nombre_cliente"]) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($cita["email_cliente"]) ?></p>
    <p><strong>Teléfono:</strong> <?= htmlspecialchars($cita["telefono_cliente"]) ?></p>
    <p><strong>Fecha:</strong> <?= htmlspecialchars($cita["fecha"]) ?></p>
    <p><strong>Hora:</strong> <?= htmlspecialchars($cita["hora"]) ?></p>

    <label>Estado actual:</label>
    <select name="estado" required>
      <option value="pendiente" <?= $cita["estado"] == "pendiente" ? "selected" : "" ?>>Pendiente</option>
      <option value="confirmada" <?= $cita["estado"] == "confirmada" ? "selected" : "" ?>>Confirmada</option>
      <option value="cancelada" <?= $cita["estado"] == "cancelada" ? "selected" : "" ?>>Cancelada</option>
    </select>

    <button type="submit" class="btn-primary">Guardar Cambios</button>

    <a href="citas_list.php?abogado_id=<?= $abogado_id ?>" class="btn-secondary">
      Volver
    </a>

  </form>
</section>

</body>
</html>