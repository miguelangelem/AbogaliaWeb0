<?php

require "php/db.php";

$stmt = $pdo->query("
    SELECT
        id,
        nombre,
        especializacion,
        ciudad,
        foto
    FROM abogados
    ORDER BY created_at DESC
");

$abogados = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Abogalia | Encuentra abogados y agenda citas</title>

    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/app.js"></script>
</head>

<body>

<header class="header">

    <div class="logo-container">
        <img
            src="assets/Logohorizontal.jpg"
            alt="Logo de Abogalia"
            class="logo"
        >
    </div>

    <nav class="nav">

        <button
            class="menu-toggle"
            id="menuToggle"
            type="button"
            aria-label="Abrir menú"
        >
            ☰
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#abogados">Abogados</a></li>
            <li>
                <a href="views/abogado_form.php">
                    Registrarse como Abogado
                </a>
            </li>
            <li><a href="#blogs">Blogs</a></li>
        </ul>

    </nav>

</header>


<section class="hero" id="inicio">

    <div class="hero-overlay">

        <h1>Abogalia</h1>

        <p class="hero-subtitle">
            Abogalia es una plataforma creada para facilitar
            el contacto con abogados confiables, permitiendo
            encontrar asesoría legal de manera rápida, clara y segura.
        </p>

        <div class="values">

            <div class="value-card">
                <h3>CONFIANZA</h3>
                <p>Tu tranquilidad, nuestra prioridad.</p>
            </div>

            <div class="value-card">
                <h3>JUSTICIA</h3>
                <p>Defendemos tus derechos.</p>
            </div>

            <div class="value-card">
                <h3>EXPERIENCIA</h3>
                <p>Abogados expertos a tu servicio.</p>
            </div>

            <div class="value-card">
                <h3>SEGURIDAD</h3>
                <p>Protegemos tu información y tu caso.</p>
            </div>

            <div class="value-card">
                <h3>RAPIDEZ</h3>
                <p>Asesoría legal sin complicaciones.</p>
            </div>

        </div>

        <a href="#abogados" class="btn-primary">
            Ver Abogados
        </a>

    </div>

</section>


<section class="section" id="abogados">

    <h2>Lista de Abogados</h2>

    <p>
        Selecciona un abogado para consultar su perfil.
    </p>


    <div class="lawyer-list">

        <?php if (empty($abogados)): ?>

            <p class="empty-message">
                Actualmente no hay abogados registrados.
            </p>

        <?php else: ?>

            <?php foreach ($abogados as $abogado): ?>

                <article class="lawyer-card">

                    <img
                        src="<?= $abogado['foto']
                            ? 'uploads/' . htmlspecialchars($abogado['foto'])
                            : 'assets/default.jpg'
                        ?>"
                        alt="Foto de <?= htmlspecialchars($abogado['nombre']) ?>"
                    >

                    <h3>
                        <?= htmlspecialchars($abogado['nombre']) ?>
                    </h3>

                    <p>
                        <strong>Especialidad:</strong>
                        <?= htmlspecialchars($abogado['especializacion']) ?>
                    </p>

                    <p>
                        <strong>Ciudad:</strong>
                        <?= htmlspecialchars($abogado['ciudad']) ?>
                    </p>

                    <a
                        href="views/abogado_profile.php?id=<?= (int) $abogado['id'] ?>"
                        class="btn-secondary"
                    >
                        Ver Perfil
                    </a>

                </article>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</section>


<section class="blogs" id="blogs">

    <h2>Blogs y noticias legales en México</h2>

    <p>
        Información útil antes de contratar cualquier servicio legal.
    </p>

    <div class="blog-links">

        <a
            href="https://www.scjn.gob.mx/"
            target="_blank"
            rel="noopener noreferrer"
        >
            Suprema Corte de Justicia de la Nación
        </a>

        <a
            href="https://www.gob.mx/profeco"
            target="_blank"
            rel="noopener noreferrer"
        >
            PROFECO - Derechos del consumidor
        </a>

        <a
            href="https://www.diputados.gob.mx/LeyesBiblio/pdf/CPEUM.pdf"
            target="_blank"
            rel="noopener noreferrer"
        >
            Constitución Mexicana
        </a>

    </div>

</section>


<footer class="footer">

    <p>
        © 2026 Abogalia. Todos los derechos reservados.
    </p>

</footer>


</body>
</html>