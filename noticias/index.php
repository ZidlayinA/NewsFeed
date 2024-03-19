<?php
session_start();
extract($_REQUEST);

require("../backend/conexion.php");

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if (!empty($categoria)) {
    // Si se proporciona una categoría, consulta noticias de esa categoría
    $instruccion = "
    SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor 
    FROM news 
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    WHERE news.categoria = '$categoria'
    ORDER BY fecha DESC
    ";

} else {

    // Si no se proporciona una categoría, consulta todas las noticias
    $instruccion = "
    SELECT news.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor 
    FROM news 
    INNER JOIN usuarios ON news.id_usuario = usuarios.id_usuario
    ORDER BY fecha DESC
    LIMIT 10
    ";
}

// Ejecuta la consulta
$resultados = $conexion->query($instruccion);
$noticias = $resultados->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagenes/logos/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <link rel="manifest" href="../manifest.json">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <link rel="icon" href="../imagenes/periodico.png" type="image/png">
    <title>El Periodico</title>
    <script type="text/javascript">
  if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("sw.js");
  }
</script>
</head>

<body>
    <!-- NAVBAR -->
    <div class="">
        <?php require("menu.php"); ?>
    </div>

    <!-- HEADER -->
    <header>
    </header>

    <!-- CONTENT -->
    <div class="container-fluid">

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($noticias as $indice => $noticia): ?>
                <?php if ($indice >= 0): ?>
                    <!-- APLCIAR COLOR AL BADGEN EN FUNCIÓN DE LA CATEGORÍA -->
                    <?php
                    $categoria = strtolower($noticia['categoria']);
                    if ($categoria == 'ciencia') {
                        $bg_body = 'text-bg-info';
                    } elseif ($categoria == 'negocios') {
                        $bg_body = 'text-bg-success';
                    } elseif ($categoria == 'tecnologia') {
                        $bg_body = 'text-bg-warning';
                    }
                    ?>

                    <div class="col">
                        <div class="card p-3 shadow  border-0 rounded-1">
                            <a class=" text-end" href="index.php?categoria=<?= $noticia['categoria'] ?>">
                                <span class="badge <?= $bg_body ?>">
                                    <?= $noticia['categoria'] ?>
                                </span>
                            </a>
                            <div class="justify-content-center align-items-center card-header">
                                <img src="../imagenes/subidas/<?= $noticia['imagen']; ?>" class="img-fluid rounded-1"
                                    alt="Imagen de la tarjeta">
                            </div>

                            <div class="card-body">
                                <a href="../backend/ver_noticia.php?id=<?= $noticia['id_noticia']; ?>"
                                    class="card-title link-secondary mb-1">
                                    <h4>
                                        <?= $noticia['titulo']; ?>
                                    </h4>
                                </a>

                                <h6 class="card-text mb-1">
                                    <?= substr($noticia['copete'], 0, 100); ?>...
                                </h6>
                            </div>
                            <div class="text-center">
                                <small>
                                    Publicada:
                                    <?= $noticia['fecha']; ?>
                                </small>
                                <small>
                                    por
                                    <?= $noticia['autor'] ?>
                                </small>
                            </div>

                            <div class="card-footer text-left">
                                <div class="text-center">
                                    <a href="../backend/ver_noticia.php?id=<?= $noticia['id_noticia']; ?>"
                                        class="btn btn-sm btn-dark" role="button">Ver noticia</a>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php $conexion = null ?>
    <?php require("footer.php"); ?>
</body>

</html>