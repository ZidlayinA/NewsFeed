<?php
// ... código de conexión a la base de datos ...
require("../backend/conexion.php");
// Consulta para obtener los comentarios
$stmt = $conexion->prepare("SELECT nombre, comentario, fecha FROM comentarios WHERE id_noticia = :id_noticia ORDER BY fecha DESC");
$stmt->bindParam(':id_noticia', $noticia['id_noticia']);
$stmt->execute();
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container comentarios">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php foreach ($comentarios as $comentario): ?>
                <div class="card mb-3" style="max-width: 400px;">
                    <div class="card-body">

                        <h5 class="card-title text-primary"><?= htmlspecialchars($comentario['nombre']); ?></h5>

                        <p class="card-text text-muted small"><?= nl2br(htmlspecialchars($comentario['comentario'])); ?></p>
                    </div>
                    <div class="card-footer text-muted text-center">
                    <?php date_default_timezone_set('America/Mexico_City'); ?>
<?= date("d/m/Y H:i:s"); ?>



                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
