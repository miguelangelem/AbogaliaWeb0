<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}


// --------------------------------------------------
// 1. Obtener datos del formulario
// --------------------------------------------------

$abogado_id = filter_input(
    INPUT_POST,
    "abogado_id",
    FILTER_VALIDATE_INT
);

$nombre = trim($_POST["nombre_cliente"] ?? "");
$email = trim($_POST["email_cliente"] ?? "");
$telefono = trim($_POST["telefono_cliente"] ?? "");
$descripcion = trim($_POST["descripcion_caso"] ?? "");
$fecha = $_POST["fecha"] ?? "";
$hora = $_POST["hora"] ?? "";


// --------------------------------------------------
// 2. Validar ID del abogado
// --------------------------------------------------

if (!$abogado_id) {
    die("El abogado seleccionado no es válido.");
}


// --------------------------------------------------
// 3. Verificar que el abogado exista
// --------------------------------------------------

$stmt = $pdo->prepare("
    SELECT id
    FROM abogados
    WHERE id = :id
");

$stmt->execute([
    ":id" => $abogado_id
]);

if (!$stmt->fetch()) {
    die("El abogado seleccionado no existe.");
}


// --------------------------------------------------
// 4. Validar campos obligatorios
// --------------------------------------------------

if (
    $nombre === "" ||
    $email === "" ||
    $telefono === "" ||
    $descripcion === "" ||
    $fecha === "" ||
    $hora === ""
) {
    die("Todos los campos son obligatorios.");
}


// --------------------------------------------------
// 5. Validar correo
// --------------------------------------------------

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}


// --------------------------------------------------
// 6. Validar fecha
// --------------------------------------------------

$fechaActual = date("Y-m-d");

if ($fecha < $fechaActual) {
    die("No puedes seleccionar una fecha anterior a hoy.");
}


// --------------------------------------------------
// 7. Verificar disponibilidad
// --------------------------------------------------

$stmt = $pdo->prepare("
    SELECT id
    FROM citas
    WHERE abogado_id = :abogado_id
      AND fecha = :fecha
      AND hora = :hora
");

$stmt->execute([
    ":abogado_id" => $abogado_id,
    ":fecha" => $fecha,
    ":hora" => $hora
]);

if ($stmt->fetch()) {
    die("El abogado ya tiene una cita registrada para esa fecha y hora.");
}


// --------------------------------------------------
// 8. Guardar cita
// --------------------------------------------------

$sql = "
    INSERT INTO citas (
        abogado_id,
        nombre_cliente,
        email_cliente,
        telefono_cliente,
        descripcion_caso,
        fecha,
        hora
    )
    VALUES (
        :abogado_id,
        :nombre,
        :email,
        :telefono,
        :descripcion,
        :fecha,
        :hora
    )
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":abogado_id" => $abogado_id,
    ":nombre" => $nombre,
    ":email" => $email,
    ":telefono" => $telefono,
    ":descripcion" => $descripcion,
    ":fecha" => $fecha,
    ":hora" => $hora
]);


// --------------------------------------------------
// 9. Regresar al perfil del abogado
// --------------------------------------------------

header(
    "Location: ../views/abogado_profile.php?id=" . $abogado_id
);

exit;