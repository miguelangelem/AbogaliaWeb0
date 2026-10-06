<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}


// --------------------------------------------------
// 1. Obtener y validar ID
// --------------------------------------------------

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("El identificador del abogado no es válido.");
}


// --------------------------------------------------
// 2. Obtener información de la fotografía
// --------------------------------------------------

$stmt = $pdo->prepare("
    SELECT foto
    FROM abogados
    WHERE id = :id
");

$stmt->execute([
    ":id" => $id
]);

$abogado = $stmt->fetch();

if (!$abogado) {
    die("El abogado no existe.");
}


// --------------------------------------------------
// 3. Eliminar registro de MySQL
// --------------------------------------------------

$stmt = $pdo->prepare("
    DELETE FROM abogados
    WHERE id = :id
");

$stmt->execute([
    ":id" => $id
]);


// --------------------------------------------------
// 4. Eliminar fotografía
// --------------------------------------------------

if (!empty($abogado["foto"])) {

    $rutaFoto = "../uploads/" . $abogado["foto"];

    if (is_file($rutaFoto)) {
        unlink($rutaFoto);
    }
}


// --------------------------------------------------
// 5. Regresar al inicio
// --------------------------------------------------

header("Location: ../index.php");
exit;