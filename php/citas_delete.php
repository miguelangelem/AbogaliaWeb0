<?php
session_start();
require "db.php";

if (!$pdo) {
    die("Database connection failed.");
}

if (!isset($_SESSION["abogado_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $abogado_id = $_POST["abogado_id"];

    if ($_SESSION["abogado_id"] != $abogado_id) {
        die("Acceso denegado.");
    }

    $stmt = $pdo->prepare("DELETE FROM citas WHERE id = :id AND abogado_id = :abogado_id");
    $stmt->execute([
        ":id" => $id,
        ":abogado_id" => $abogado_id
    ]);

    header("Location: ../views/citas_list.php?abogado_id=" . $abogado_id);
    exit();
}