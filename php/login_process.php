<?php
session_start();
require "db.php";

if (!isset($pdo) || !($pdo instanceof PDO)) {
    die("Database connection error.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM abogados WHERE email = :email");
    $stmt->execute([":email" => $email]);
    $abogado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($abogado && password_verify($password, $abogado["password_hash"])) {

        $_SESSION["abogado_id"] = $abogado["id"];
        $_SESSION["abogado_nombre"] = $abogado["nombre"];

        header("Location: ../views/panel.php");
        exit();

    } else {
        echo "Correo o contraseña incorrectos.";
    }
}