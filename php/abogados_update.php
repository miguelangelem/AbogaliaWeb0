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
// 2. Recibir datos
// --------------------------------------------------

$nombre = trim($_POST["nombre"] ?? "");
$especializacion = trim($_POST["especializacion"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");
$ciudad = trim($_POST["ciudad"] ?? "");
$direccion = trim($_POST["direccion"] ?? "");
$email = trim($_POST["email"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");


// --------------------------------------------------
// 3. Validar campos
// --------------------------------------------------

if (
    $nombre === "" ||
    $especializacion === "" ||
    $descripcion === "" ||
    $ciudad === "" ||
    $direccion === "" ||
    $email === "" ||
    $telefono === ""
) {
    die("Todos los campos son obligatorios.");
}


// --------------------------------------------------
// 4. Validar correo
// --------------------------------------------------

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}


// --------------------------------------------------
// 5. Actualizar información
// --------------------------------------------------

$sql = "
    UPDATE abogados
    SET
        nombre = :nombre,
        especializacion = :especializacion,
        descripcion = :descripcion,
        ciudad = :ciudad,
        direccion = :direccion,
        email = :email,
        telefono = :telefono
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":nombre" => $nombre,
    ":especializacion" => $especializacion,
    ":descripcion" => $descripcion,
    ":ciudad" => $ciudad,
    ":direccion" => $direccion,
    ":email" => $email,
    ":telefono" => $telefono,
    ":id" => $id
]);


// --------------------------------------------------
// 6. Regresar al perfil
// --------------------------------------------------

header("Location: ../views/abogado_profile.php?id=" . $id);
exit;