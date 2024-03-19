<?php

require("../backend/conexion.php");

    // Establecer el modo de error PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Preparar la sentencia SQL
        $stmt = $conexion->prepare("INSERT INTO comentarios (nombre, comentario, id_noticia) VALUES (:nombre, :comentario, :id_noticia)");

        // Vincular parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':id_noticia', $id_noticia);

        // Asignar valores a los parámetros
        $nombre = $_POST['nombre'];
        $comentario = $_POST['comentario'];
        $id_noticia = $_POST['id_noticia'];

        // Ejecutar la consulta
        $stmt->execute();
        echo "<script>alert('Nuevo comentario registrado con éxito');</script>";
        echo "<script>window.location= 'noticia.php'</script>";
    
}else {
    echo "error";
}

// Cerrar la conexión
$conexion->close();
?>
