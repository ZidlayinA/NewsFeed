<?php
session_start();
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:index.php");

require("conexion.php");

// Manejando imágenes
$copiarArchivo = false;
if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $nombreDirectorio = "../imagenes/subidas/";
    $idUnico = time();
    $nombrefichero = $idUnico . "-" . $_FILES['imagen']['name'];
    $copiarArchivo = true;
} else
    $nombrefichero = $imagenedit;

if ($copiarArchivo) {
    unlink($nombreDirectorio . $imagenedit);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreDirectorio . $nombrefichero);
}

// Interacción con la base de datos
$sql = "UPDATE news 
                SET titulo=:titulo, copete=:copete, cuerpo=:cuerpo, imagen=:imagen, categoria=:categoria 
                WHERE id_noticia=:id_noticia";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar los valores a los marcadores de posición
$instruccion->bindParam(':titulo', $titulo, PDO::PARAM_STR);
$instruccion->bindParam(':copete', $copete, PDO::PARAM_STR);
$instruccion->bindParam(':cuerpo', $cuerpo, PDO::PARAM_STR);
$instruccion->bindParam(':imagen', $nombrefichero, PDO::PARAM_STR);
$instruccion->bindParam(':categoria', $categoria, PDO::PARAM_STR);
$instruccion->bindParam(':id_noticia', $id_noticia, PDO::PARAM_INT);

// Ejecutar la consulta
$instruccion->execute();
// Cerrando conexión
$conexion = null;
//Redirección a la página de edición
header("location:../admin/index.php?mensaje=Publicación editada con exito&id_noticia=" . $id_noticia);
?>