<?php
// ... código de conexión a la base de datos ...
require("../backend/conexion.php");
// Consulta para obtener los comentarios
$stmt = $conexion->prepare("SELECT nombre, comentario, fecha FROM comentarios WHERE id_noticia = :id_noticia ORDER BY fecha DESC");
$stmt->bindParam(':id_noticia', $noticia['id_noticia']);
$stmt->execute();
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class="comentarios">
    <h3>Comentarios</h3>
    <?php foreach ($comentarios as $comentario): ?>
        <div class="comentario">
            <p class="nombre"><strong><?= htmlspecialchars($comentario['nombre']); ?></strong> dijo:</p>
            <p class="texto"><?= nl2br(htmlspecialchars($comentario['comentario'])); ?></p>
            <p class="fecha"><?= htmlspecialchars($comentario['fecha']); ?></p>
        </div>
    <?php endforeach; ?>
</div>