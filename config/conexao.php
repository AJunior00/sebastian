<?php 


$host = "localhost";
$banco = "sebastian315";
$usuario = "sebastian315";
$senha = "315!@#";

try{
    
    $pdo = new PDO ("mysql:host=$host;dbname=$banco; charset=utf8mb4", $usuario, $senha);

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $erro) {
    throw $erro;
}
