<?php
session_start();
require "db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $abogado_id = $_POST["abogado_id"];
    $estado = $_POST["estado"];

    // Seguridad: solo el abogado dueño puede actualizar
    if ($_SESSION["abogado_id"] != $abogado_id) {
        die("Acceso denegado.");
    }

    if (!isset($pdo) || $pdo === null) {
        die("Database connection failed.");
    }

    $stmt = $pdo->prepare("UPDATE citas SET estado = :estado WHERE id = :id AND abogado_id = :abogado_id");
    if (!$stmt) {
        die("Error preparing statement.");
    }
    $stmt->execute([
        ":estado" => $estado,
        ":id" => $id,
        ":abogado_id" => $abogado_id
    ]);

    header("Location: ../views/citas_list.php?abogado_id=" . $abogado_id);
    exit();
}