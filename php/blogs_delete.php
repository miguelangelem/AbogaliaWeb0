<?php
session_start();
require "db.php";

if (!isset($_SESSION["abogado_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    if ($pdo !== null) {
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = :id");
    $stmt->execute([":id" => $id]);
    }

    header("Location: ../views/blogs_list.php");
    exit();
}