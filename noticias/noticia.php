<?php
session_start();
extract($_REQUEST);
$noticia = $_SESSION['ver_noticia'];

$categoria = strtolower($noticia['categoria']);
if ($categoria == 'sociales') {
    $bg_body = 'text-bg-info';
} elseif ($categoria == 'deportes') {
    $bg_body = 'text-bg-danger';
} elseif ($categoria == 'moda') {
    $bg_body = 'text-bg-warning';
}

?>

<!DOCTYPE html>
<html lang="es">

<!--===========HEAD=============-->

<head>
    <!---------- metas ---------->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="imagenes/logos/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">

    <!---------- title ---------->
    <link rel="shortcut icon" href="../imagenes/logos/favicon.png" type="image/x-icon">
    
    <title>
        <?= $noticia['titulo']; ?>
    </title>
<style>
    .comentarios {
    margin-top: 20px;
}

.comentario {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
}

.comentario .nombre {
    font-weight: bold;
}

.comentario .fecha {
    font-size: 0.8em;
    color: #666;
}

</style>
</head>

<!--===========BODY=============-->

<body>
    <?php require("menu.php") ?>
    <div class="card border-0 bg-transparent">
        <header class="card-header border-0">
            <hgroup class="text-center mb-3">
                <a class="text-link" href="" class="mx-1">
                    <span class="badge <?= $bg_body ?>">
                        <?= $noticia['categoria'] ?>
                    </span>
                </a>
                <h1 class="display-4">
                    <?= $noticia['titulo']; ?>
                </h1>
                <h5 class="fs-3">
                    <?= $noticia['copete']; ?>
                </h5>
                <div class="">
                    <small class="text-center">
                        Publicada
                        <span class="badge text-bg-dark">
                            <?= $noticia['fecha'] ?>
                        </span>
                        Autor
                        <span class="badge text-bg-dark">
                            <?= $noticia['autor'] ?><span>
                    </small>
                </div>
            </hgroup>
            <div class="card-img d-flex justify-content-center">
                <img src="../imagenes/subidas/<?= $noticia['imagen']; ?>" class=" img-fluid rounded-1"
                    alt="Imagen de la tarjeta" width="70%">
            </div>
        </header>

        <main class="card-body border-0 container">
            <section>
                <article class="card-text">
                    <?= nl2br($noticia['cuerpo']); ?>
                </article>
            </section>
            <div class="comentarios">
  <h3>Comentarios</h3>
  <ul id="lista-comentarios"></ul>
  <form id="formulario-comentario" action="comentarios.php" method="post">
    <input class="form-control" type="text" name="nombre" placeholder="Nombre" required>
    <textarea class="form-control" name="comentario" placeholder="Escribe tu comentario" required></textarea>
    <!-- Campo oculto para la ID de la noticia -->
    <input type="hidden" name="id_noticia" value="<?= $noticia['id_noticia']; ?>">
    <button type="submit" class="btn btn-primary shadow-lg border-1">Enviar</button>
    <?php require("mostrar_comentarios.php") ?>
</form>
</div>
        </main>
   

    </div>

    <?php require("footer.php"); ?>

</body>

</html>

