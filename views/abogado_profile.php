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
        foto,
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

    <title>
        <?= htmlspecialchars($abogado["nombre"]) ?> | Abogalia
    </title>

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

    <h2>
        <?= htmlspecialchars($abogado["nombre"]) ?>
    </h2>

    <div class="lawyer-card">

        <img
            src="<?= $abogado["foto"]
                ? "../uploads/" . htmlspecialchars($abogado["foto"])
                : "../assets/default.jpg"
            ?>"
            alt="Foto de <?= htmlspecialchars($abogado["nombre"]) ?>"
        >


        <h3>
            <?= htmlspecialchars($abogado["especializacion"]) ?>
        </h3>


        <p>
            <strong>Ciudad:</strong>
            <?= htmlspecialchars($abogado["ciudad"]) ?>
        </p>


        <p>
            <strong>Dirección:</strong>
            <?= htmlspecialchars($abogado["direccion"]) ?>
        </p>


        <p>
            <strong>Correo:</strong>
            <?= htmlspecialchars($abogado["email"]) ?>
        </p>


        <p>
            <strong>Teléfono:</strong>
            <?= htmlspecialchars($abogado["telefono"]) ?>
        </p>


        <p>
            <strong>Descripción:</strong>
        </p>

        <p>
            <?= nl2br(htmlspecialchars($abogado["descripcion"])) ?>
        </p>


        <div class="profile-actions">

            <a
                href="../index.php"
                class="btn-secondary"
            >
                Volver
            </a>



            <a
                href="cita_form.php?abogado_id=<?= (int) $abogado["id"] ?>"
                class="btn-primary"
            >
                Solicitar Cita
            </a>


            
            <a
                href="abogado_edit.php?id=<?= (int) $abogado["id"] ?>"
                class="btn-primary"
            >
                Editar
            </a>


            <form
                action="../php/abogados_delete.php"
                method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este perfil?');"
            >

                <input
                    type="hidden"
                    name="id"
                    value="<?= (int) $abogado["id"] ?>"
                >

                <button
                    type="submit"
                    class="btn-danger"
                >
                    Eliminar Perfil
                </button>

            </form>

        </div>

    </div>

</section>


</body>
</html>