<?php
$host = "localhost";
$db = "todo_app";
$user = "root";
$pass = "root";

try {
    $conn = new PDO("mySQL:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    ["error" => $e->getMessage()];
}