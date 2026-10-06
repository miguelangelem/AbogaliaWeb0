<?php

require "../php/db.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("El identificador del abogado no es válido.");
}

$stmt = $pdo->prepare("
    SELECT
        id,
        nombre,
        especializacion,
        descripcion,
        ciudad,
        direccion,
        email,
        telefono
    FROM abogados
    WHERE id = :id
");

$stmt->execute([
    ":id" => $id
]);

$abogado = $stmt->fetch();

if (!$abogado) {
    die("Abogado no encontrado.");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar Abogado | Abogalia</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<header class="header">

    <div class="logo-container">

        <img
            src="../assets/Logohorizontal.jpg"
            alt="Logo de Abogalia"
            class="logo"
        >

    </div>

</header>


<section class="section">

    <h2>Editar Perfil</h2>

    <p>
        Modifica la información del abogado.
    </p>


    <form
        class="quote-form"
        action="../php/abogados_update.php"
        method="POST"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $abogado["id"] ?>"
        >


        <div class="form-group">

            <label for="nombre">
                Nombre completo
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="<?= htmlspecialchars($abogado["nombre"]) ?>"
                autocomplete="name"
                required
            >

        </div>


        <div class="form-group">

            <label for="especializacion">
                Especialización
            </label>

            <input
                type="text"
                id="especializacion"
                name="especializacion"
                value="<?= htmlspecialchars($abogado["especializacion"]) ?>"
                required
            >

        </div>


        <div class="form-group">

            <label for="descripcion">
                Descripción profesional
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                required
            ><?= htmlspecialchars($abogado["descripcion"]) ?></textarea>

        </div>


        <div class="form-group">

            <label for="ciudad">
                Ciudad
            </label>

            <input
                type="text"
                id="ciudad"
                name="ciudad"
                value="<?= htmlspecialchars($abogado["ciudad"]) ?>"
                autocomplete="address-level2"
                required
            >

        </div>


        <div class="form-group">

            <label for="direccion">
                Dirección
            </label>

            <input
                type="text"
                id="direccion"
                name="direccion"
                value="<?= htmlspecialchars($abogado["direccion"]) ?>"
                autocomplete="street-address"
                required
            >

        </div>


        <div class="form-group">

            <label for="email">
                Correo electrónico
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($abogado["email"]) ?>"
                autocomplete="email"
                required
            >

        </div>


        <div class="form-group">

            <label for="telefono">
                Teléfono
            </label>

            <input
                type="tel"
                id="telefono"
                name="telefono"
                value="<?= htmlspecialchars($abogado["telefono"]) ?>"
                autocomplete="tel"
                required
            >

        </div>


        <div>

            <button
                type="submit"
                class="btn-primary"
            >
                Guardar Cambios
            </button>


            <a
                href="abogado_profile.php?id=<?= (int) $abogado["id"] ?>"
                class="btn-secondary"
            >
                Cancelar
            </a>

        </div>

    </form>

</section>

</body>
</html>