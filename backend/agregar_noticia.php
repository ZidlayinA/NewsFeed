<?php

session_start();

extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

require("conexion.php");

// Formato fecha
$fecha = date("Y-m-d"); 

$id_usuario = $_SESSION['id_usuario'];

// Manejando imágenes
$copiarArchivo = false;
if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $nombreDirectorio = "../imagenes/subidas/";
    $idUnico = time();
    $nombrefichero = $idUnico . "-" . $_FILES['imagen']['name'];
    $copiarArchivo = true;
} else
    $nombrefichero = "";

if ($copiarArchivo)
    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreDirectorio . $nombrefichero);

// Comando SQL
$sql = "INSERT INTO news (titulo, copete, cuerpo, imagen, categoria, id_usuario, fecha)
        VALUES (:titulo, :copete, :cuerpo, :imagen, :categoria, :id_usuario, :fecha)";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar los valores a los marcadores de posición
$instruccion->bindParam(':titulo', $titulo);
$instruccion->bindParam(':copete', $copete);
$instruccion->bindParam(':cuerpo', $cuerpo);
$instruccion->bindParam(':imagen', $nombrefichero);
$instruccion->bindParam(':categoria', $categoria);
$instruccion->bindParam(':id_usuario', $id_usuario);
$instruccion->bindParam(':fecha', $fecha);

// Ejecutar la consulta
if ($instruccion->execute()) {
    header("location:../admin/mis_publicaciones.php?mensaje=Publicación exitosa");
} else {
    header("location:../admin/mis_publicaciones.php?mensaje=Ha ocurrido un error");
}
// Cerrando conexión
$conexion = null; // Cierra la conexión PDO
?>