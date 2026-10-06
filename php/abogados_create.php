<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../views/abogado_form.php");
    exit;
}


// --------------------------------------------------
// 1. Recibir y limpiar datos
// --------------------------------------------------

$nombre = trim($_POST["nombre"] ?? "");
$especializacion = trim($_POST["especializacion"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");
$ciudad = trim($_POST["ciudad"] ?? "");
$direccion = trim($_POST["direccion"] ?? "");
$email = trim($_POST["email"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");


// --------------------------------------------------
// 2. Validar campos obligatorios
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
// 3. Validar correo
// --------------------------------------------------

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}


// --------------------------------------------------
// 4. Procesar fotografía
// --------------------------------------------------

$fotoNombre = null;

if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
        die("No se pudo subir la fotografía.");
    }


    // Tamaño máximo: 5 MB
    $maxSize = 5 * 1024 * 1024;

    if ($_FILES["foto"]["size"] > $maxSize) {
        die("La fotografía no puede superar los 5 MB.");
    }


    // Detectar el tipo real del archivo
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    $mime = $finfo->file($_FILES["foto"]["tmp_name"]);


    $tiposPermitidos = [
        "image/jpeg" => "jpg",
        "image/png"  => "png",
        "image/webp" => "webp"
    ];


    if (!isset($tiposPermitidos[$mime])) {
        die("El formato de la fotografía no es válido.");
    }


    // Crear carpeta uploads si no existe
    $directorio = "../uploads/";

    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }


    // Generar nombre único
    $fotoNombre = bin2hex(random_bytes(16))
        . "."
        . $tiposPermitidos[$mime];


    $rutaDestino = $directorio . $fotoNombre;


    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaDestino)) {
        die("No se pudo guardar la fotografía.");
    }
}


// --------------------------------------------------
// 5. Guardar abogado en MySQL
// --------------------------------------------------

$sql = "
    INSERT INTO abogados (
        nombre,
        especializacion,
        descripcion,
        foto,
        ciudad,
        direccion,
        email,
        telefono
    )
    VALUES (
        :nombre,
        :especializacion,
        :descripcion,
        :foto,
        :ciudad,
        :direccion,
        :email,
        :telefono
    )
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":nombre" => $nombre,
    ":especializacion" => $especializacion,
    ":descripcion" => $descripcion,
    ":foto" => $fotoNombre,
    ":ciudad" => $ciudad,
    ":direccion" => $direccion,
    ":email" => $email,
    ":telefono" => $telefono
]);


// --------------------------------------------------
// 6. Regresar a la página principal
// --------------------------------------------------

header("Location: ../index.php");
exit;