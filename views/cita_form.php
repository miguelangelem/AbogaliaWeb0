<?php

require "../php/db.php";

$id = filter_input(INPUT_GET, "abogado_id", FILTER_VALIDATE_INT);

if (!$id) {
    die("El identificador del abogado no es válido.");
}


$stmt = $pdo->prepare("
    SELECT
        id,
        nombre,
        especializacion
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

    <title>Solicitar Cita | Abogalia</title>

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

    <h2>Solicitar una cita</h2>

    <p>
        Solicita una cita con el siguiente abogado:
    </p>


    <div class="lawyer-card">

        <h3>
            <?= htmlspecialchars($abogado["nombre"]) ?>
        </h3>

        <p>
            <strong>Especialización:</strong>
            <?= htmlspecialchars($abogado["especializacion"]) ?>
        </p>

    </div>


    <form
        class="quote-form"
        action="../php/create_cita.php"
        method="POST"
    >

        <input
            type="hidden"
            name="abogado_id"
            value="<?= (int) $abogado["id"] ?>"
        >


        <div class="form-group">

            <label for="nombre_cliente">
                Nombre completo
            </label>

            <input
                type="text"
                id="nombre_cliente"
                name="nombre_cliente"
                autocomplete="name"
                required
            >

        </div>


        <div class="form-group">

            <label for="email_cliente">
                Correo electrónico
            </label>

            <input
                type="email"
                id="email_cliente"
                name="email_cliente"
                autocomplete="email"
                required
            >

        </div>


        <div class="form-group">

            <label for="telefono_cliente">
                Teléfono
            </label>

            <input
                type="tel"
                id="telefono_cliente"
                name="telefono_cliente"
                autocomplete="tel"
                required
            >

        </div>


        <div class="form-group">

            <label for="descripcion_caso">
                Descripción del caso
            </label>

            <textarea
                id="descripcion_caso"
                name="descripcion_caso"
                placeholder="Describe brevemente el motivo de tu consulta."
                required
            ></textarea>

        </div>


        <div class="form-group">

            <label for="fecha">
                Fecha
            </label>

            <input
                type="date"
                id="fecha"
                name="fecha"
                min="<?= date("Y-m-d") ?>"
                required
            >

        </div>


        <div class="form-group">

            <label for="hora">
                Hora
            </label>

            <input
                type="time"
                id="hora"
                name="hora"
                required
            >

        </div>


        <div>

            <button
                type="submit"
                class="btn-primary"
            >
                Solicitar cita
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