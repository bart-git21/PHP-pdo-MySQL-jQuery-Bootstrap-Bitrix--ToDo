<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

class CMyComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $host = "localhost";
        $db = "todo_app";
        $user = "root";
        $pass = "root";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM tasks");
            $stmt->execute();

            $this->arResult["TASKS"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->arResult["ERROR"] = "Database error: " . $e->getMessage();
        }

        $this->IncludeComponentTemplate();
    }
}