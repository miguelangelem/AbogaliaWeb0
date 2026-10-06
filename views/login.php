<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Abogado | Abogalia</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="header">
  <div class="logo-container">
    <img src="../assets/Logohorizontal.jpg" class="logo">
  </div>
</header>

<section class="quote">
  <h2>Acceso para Abogados</h2>
  <p>Inicia sesión para administrar tu perfil y tus citas.</p>

  <form class="quote-form" action="../php/login_process.php" method="POST">
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>

    <button type="submit" class="btn-primary">Ingresar</button>
    <a href="../index.php" class="btn-secondary">Volver</a>
  </form>
</section>

</body>
</html>