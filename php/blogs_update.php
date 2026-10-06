<?php
session_start();
require "db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $enlace = $_POST["enlace"];

    if ($pdo !== null) {
        $stmt = $pdo->prepare("UPDATE blogs 
                        SET titulo = :titulo, descripcion = :descripcion, enlace = :enlace 
                        WHERE id = :id");
    }
    

    $stmt->execute([
        ":titulo" => $titulo,
        ":descripcion" => $descripcion,
        ":enlace" => $enlace,
        ":id" => $id
    ]);

    header("Location: ../views/blogs_list.php");
    exit();
}