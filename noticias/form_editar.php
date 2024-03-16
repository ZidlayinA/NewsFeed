<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:index.php");

require("../backend/conexion.php");

$instruccion = "SELECT * FROM news WHERE id_noticia = '$id_noticia'";
$resultado = $conexion->query($instruccion);
$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">

</head>

<body>

    <?php require("menu.php"); ?>

    <div class="container">
        <h1>Noticias Editar</h1>
        <?php
        if (isset($mensaje))
            print("<h3 style='color:#cc00ff'>" . $mensaje . "</h3>");
        ?>

        <form action="../backend/editar_noticia.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="titulo" required
                    value="<?php print($resultado['titulo']); ?>">
            </div>
            <div class="mb-3">
                <label for="copete" class="form-label">Copete</label>
                <input type="text" class="form-control" id="copete" name="copete" required
                    value="<?php print($resultado['copete']); ?>">
            </div>
            <div class="mb-3">
                <label for="cuerpo" class="form-label">cuerpo</label>
                <textarea name="cuerpo" id="cuerpo" cols="30" rows="10" class="form-control" required>
                    <?= $resultado['cuerpo']; ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen"></input>
                <img src="../imagenes/subidas/<?php print($resultado['imagen']); ?>" width="80px">
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="Negocios" <?php if ($resultado['categoria'] == "Negocios")
                        print("selected"); ?>>Negocios
                    </option>
                    <option value="Tecnologia" <?php if ($resultado['categoria'] == "Tecnologia")
                        print("selected"); ?>>Tecnología</option>
                    <option value="Ciencia" <?php if ($resultado['categoria'] == "Ciencia")
                        print("selected"); ?>>Ciencia
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <input type="hidden" name="imagenedit" value="<?php print($resultado['imagen']); ?>">
                <input type="hidden" name="id_noticia" value="<?php print($resultado['id_noticia']); ?>">
                <input type="submit" class="btn btn-dark" id="enviar" name="enviar" value="Guardar">
                <a href="../admin/mis_publicaciones.php" class="btn btn-outline-primary">Cancelar</a>
            </div>

        </form>
    </div>

    <div id="librerias">
        <script>
            $(document).ready(function () {
                $('#cuerpo').summernote({
                    height: 200
                });
            });
        </script>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>