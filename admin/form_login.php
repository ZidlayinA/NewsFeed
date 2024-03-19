<!-- PHP INIT CONFIGURATIONS -->
<?php require("menu.php"); ?>
<?php
session_start();
extract($_REQUEST);
if (isset($_SESSION['usuario_logueado']))
    header("location:index.php");
?>

<!-- HMTL DOCUMENT -->
<!DOCTYPE html>
<html lang="es">

<head>
<link rel="icon" href="../imagenes/periodico.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">
    
    
    <title>Inicio de sesion</title>
    <style>
        .book-animation {
            position: absolute;
            top: -20px;
            left: -20px;
            width: 120px;
            height: 150px;
            background: url('https://image.flaticon.com/icons/png/512/25/25634.png') no-repeat center center;
            animation: bookRotate 5s linear infinite;
        }

        @keyframes bookRotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body style="background-image: url('../imagenes/fondo.jpeg')">
 

    <div class=" text-center position-relative">
        <div class="book-animation"></div>
        <div class="row">
            <div class="form-signin bg-secondary-white card col-4 offset-4 p-3 mt-2 shadow-lg rounded-4">
                <div class="mb-4">
                    <?php
                    if (isset($mensaje)) {
                        print("<small class='alert alert-danger'>" . $mensaje . "</small>");
                    }
                    ?>
                </div>

                <form action="../backend/login.php" method="post" class="">
                    <img class="mb-4" src="../imagenes/logos/login.png" alt="" width="150" />
                    <h1 class="h3 mb-1 fw-normal"></h1>
                    <div class="mb-1 form-floating">

                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario"
                            required>


                        <label for="usuario" class="form-label">
                            Usuario
                        </label>

                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password"
                            required>

                        <label for="password" class="form-label">
                            Contraseña
                        </label>

                    </div>



                    
                    <div class="mb-3">
                  
                        <input type="submit" class="btn btn-primary shadow-lg border-1 btn-submit" id="enviar" name="enviar"
                            value="Acceder">

                    </div>
                </form>
            </div>
        </div>
        <?php require("../noticias/footer.php"); ?>
    </div>
</body>

</html>
