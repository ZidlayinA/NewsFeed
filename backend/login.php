<?php
/************************ CONFIGURACIONES **************************/
session_start();

extract($_REQUEST);
require("conexion.php");

/**************** SANEAMIENTO DE DATOS *************************/
$salt = substr($usuario, 0, 2);
$clave_crypt = crypt($password, $salt);
/**************** INTERACCIÓN CON LA BASE DE DATOS *************************/
$sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";

try {
    // Preparar la consulta
    $instruccion = $conexion->prepare($sql);
    // Asignar los valores a los marcadores de posición
    $instruccion->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $instruccion->bindParam(':password', $clave_crypt, PDO::PARAM_STR);
    $instruccion->execute();

    $numero_filas = $instruccion->rowCount();

    // Credenciales válidas
    if ($numero_filas > 0) {
        $resultado = $instruccion->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nombre'] = $resultado['nombre'];
        $_SESSION['apellido'] = $resultado['apellido'];
        $_SESSION['id_usuario'] = $resultado['id_usuario'];
        $_SESSION['rol'] = $resultado['rol'];
        $_SESSION['usuario_logueado'] = "SI";
        header("location:../admin/index.php");

        // Credenciales inválidas
    } else {
        $_SESSION['mensaje'] = "Usuario y contraseña incorrecto";
        header("location:../admin/form_login.php?mensaje=Usuario y contraseña incorrecto");
    }

    // Errores en la interacción
} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Fallo en la consulta: " . $e->getMessage();
    header("location:../admin/form_login.php?mensaje=Fallo en la consulta".$e->getMessage());

    // Cerrar conexión
} finally {
    $conexion = null;
}
?>