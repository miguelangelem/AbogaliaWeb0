<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $abogado_id = $_POST["abogado_id"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $comentario = $_POST["comentario"];
    $calificacion = $_POST["calificacion"];

    $sql = "INSERT INTO comentarios (abogado_id, nombre_usuario, comentario, calificacion)
            VALUES (:abogado_id, :nombre_usuario, :comentario, :calificacion)";

    /** @var PDO $pdo */
    if (!isset($pdo) || $pdo === null) {
        throw new RuntimeException("Database connection unavailable");
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":abogado_id" => $abogado_id,
        ":nombre_usuario" => $nombre_usuario,
        ":comentario" => $comentario,
        ":calificacion" => $calificacion
    ]);

    header("Location: ../views/abogado_profile.php?id=" . $abogado_id);
    exit();
}