<?php
session_start();
require "db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $enlace = $_POST["enlace"];

    if ($pdo !== null) {
        $stmt = $pdo->prepare("INSERT INTO blogs (titulo, descripcion, enlace) VALUES (:titulo, :descripcion, :enlace)");
        if ($stmt) {
        $stmt->execute([
            ":titulo" => $titulo,
            ":descripcion" => $descripcion,
            ":enlace" => $enlace
        ]);

        header("Location: ../views/blogs_list.php");
        exit();
    }
}
}