<?php
session_start();
require "../php/db.php";

if (!isset($pdo) || $pdo === null) {
    die("Error de conexión a la base de datos.");
}

if (!isset($_SESSION["abogado_id"])) {
    header("Location: login.php");
    exit();
}

$abogado_id = $_GET["abogado_id"];

// Seguridad: solo el dueño puede ver sus citas
if ($_SESSION["abogado_id"] != $abogado_id) {
    die("Acceso denegado.");
}

// Obtener datos del abogado
$stmtAbogado = $pdo->prepare("SELECT * FROM abogados WHERE id = :id");
if (!$stmtAbogado) {
    die("Error preparing statement.");
}
$stmtAbogado->execute([":id" => $abogado_id]);
$abogado = $stmtAbogado->fetch(PDO::FETCH_ASSOC);

if (!$abogado) {
    die("Abogado no encontrado.");
}

// Obtener citas
$stmt = $pdo->prepare("SELECT * FROM citas WHERE abogado_id = :id ORDER BY fecha ASC, hora ASC");
$stmt->execute([":id" => $abogado_id]);
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Citas | Abogalia</title>
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
  <h2>Mis citas agendadas</h2>
  <p>Abogado: <strong><?= htmlspecialchars($abogado["nombre"]) ?></strong></p>

  <?php if (count($citas) == 0): ?>
    <p style="margin-top:20px;">No hay citas registradas aún.</p>
  <?php else: ?>
    <?php foreach($citas as $cita): ?>
      <div class="lawyer-card" style="margin-top:20px;">

        <h3><?= htmlspecialchars($cita["nombre_cliente"]) ?></h3>

        <p><strong>Correo:</strong> <?= htmlspecialchars($cita["email_cliente"]) ?></p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($cita["telefono_cliente"]) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($cita["fecha"]) ?></p>
        <p><strong>Hora:</strong> <?= htmlspecialchars($cita["hora"]) ?></p>

        <p style="margin-top:10px;">
          <strong>Estado:</strong>
          <span style="color:#d4af37; font-weight:bold;">
            <?= htmlspecialchars($cita["estado"]) ?>
          </span>
        </p>

        <p style="margin-top:15px;"><strong>Descripción del caso:</strong></p>
        <p><?= htmlspecialchars($cita["descripcion_caso"]) ?></p>

        <div style="margin-top:20px; display:flex; gap:15px; flex-wrap:wrap;">
          <a class="btn-primary" href="citas_edit.php?id=<?= $cita["id"] ?>&abogado_id=<?= $abogado_id ?>">
            Cambiar estado
          </a>

          <form action="../php/citas_delete.php" method="POST">
            <input type="hidden" name="id" value="<?= $cita["id"] ?>">
            <input type="hidden" name="abogado_id" value="<?= $abogado_id ?>">
            <button type="submit" class="btn-secondary">Eliminar</button>
          </form>
        </div>

      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <br>
  <a href="panel.php" class="btn-secondary">Volver al panel</a>
</section>

</body>
</html>