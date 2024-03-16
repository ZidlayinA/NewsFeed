<?php

extract($_REQUEST);

// Importaciones
require("conexion.php");

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

$id_usuario=$_SESSION['id_usuario'];

$instruccion = "
    SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM news 
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    WHERE news.id_usuario = '$id_usuario'
";

if (!isset($categoria)) {

    $instruccion = "
    SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM news 
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    WHERE news.id_usuario = '$id_usuario'
";
} else {
    $instruccion = "
        SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
        FROM news 
        INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
        WHERE news.id_usuario = '$id_usuario'
        AND news.categoria = '$categoria'
        ORDER BY news.fecha DESC
    ";
}



$mis_noticias = $conexion->query($instruccion);
$conexion = null;
?>