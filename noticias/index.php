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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="../estaticos/css/style.css">

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
            <button type="button" class="btn-flotante" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal"><img src="icono.png" style="width: 30px; height: 30px;"></button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel" style="color: #256894;"><b>clima en la palma de tu mano</b></h4>
                      <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-sm">
                            <section class="top-banner">
                                <div class="container-sm">
                                <h3 class="">Consulta el clima de tu ciudad</h3><br><br>
                                <form>
                                    <div class="input-group mb-3">
                                        <input type="text" class="" placeholder="Escribe aquí" aria-describedby="button-addon2" autofocus/>
                                        <button class="btn btn-outline-dark" type="submit" id="button-addon2" data-mdb-ripple-init data-mdb-ripple-color="dark">Buscar</button>
                                        <span class="msg"></span>
                                      </div>
                                </form>
                                </div>
                            </section>
                            <section class="ajax-section">
                                <div class="container">
                                <ul class="cities"></ul>
                                </div>
                            </section>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <?php $conexion = null ?>
    <?php require("footer.php"); ?>
    
</body>

</html>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

<style>
    .btn-flotante {width: auto; height: auto; color: #ffffff; border: none; border-radius: 5px; padding: 18px 30px; position: fixed; bottom: 40px; right: 40px; transition: all 300ms ease 0ms; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); z-index: 99;}
    .btn-flotante:hover { background-color: #256894; box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3); transform: translateY(-7px); }
    @media only screen and (max-width: 600px) { .btn-flotante { font-size: 14px; padding: 12px 20px; bottom: 20px; right: 20px;}}
    a { color: inherit; text-decoration: none; }
    * { margin: 0; padding: 0; box-sizing: border-box; font-weight: normal; }
    button { cursor: pointer; }
    input { -webkit-appearance: none; }
    button, input { border: none; background: none; outline: none; color: inherit; }
    img { display: block; max-width: 100%; height: auto; }
    ul { list-style: none; }
    body { font: 1rem/1.3 "Roboto", sans-serif; background: var(--bg_main); color: var(--text_dark); padding: 70px; }
    .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px;}
    .top-banner {color: var(--text_light); }
    .heading { font-weight: bold; font-size: 4rem; letter-spacing: 0.02em; padding: 0 0 30px 0; }
    .top-banner form { position: relative; display: flex; align-items: center; }
    .top-banner form input {font-size: 2rem;height: 40px;padding: 5px 5px 10px;border-bottom: 1px solid;}
    .top-banner form input::placeholder {color: currentColor; }
    .top-banner form button {font-size: 1rem;font-weight: bold;letter-spacing: 0.1em;padding: 15px 20px;margin-left: 15px;border-radius: 5px;background: var(--red);transition: background 0.3s ease-in-out;}
    .top-banner form button:hover {background: var(--darkred);}
    .top-banner form .msg {position: absolute;bottom: -40px;left: 0;max-width: 450px;min-height: 40px;}
    .ajax-section {margin: 70px 0 20px;}
    .ajax-section .cities {display: grid;grid-gap: 32px 20px;grid-template-columns: repeat(4, 1fr);}
    .ajax-section .city {position: relative;padding: 40px 10%;letter-spacing: 0.05em;border-radius: 20px;background: var(--text_light);color: var(--text_med);}
    .ajax-section .city::after {content: '';width: 90%;height: 50px;position: absolute;bottom: -12px;left: 5%;z-index: -1;opacity: 0.3;border-radius: 20px;background: var(--text_light);}
    .ajax-section figcaption {margin-top: 10px;text-transform: uppercase;letter-spacing: 0.05em;}
    .ajax-section .city-temp {font-size: 5rem;font-weight: bold;letter-spacing: 0.05em;margin-top: 10px;color: var(--text_dark);}
    .ajax-section .city sup {font-size: 0.5em;}
    .ajax-section .city-name sup {padding: 0.2em 0.6em;letter-spacing: 0.05em;border-radius: 30px;color: var(--text_light);background: var(--orange);}
    .ajax-section .city-icon {margin-top: 10px;width: 100px;height: 100px;}
    @media screen and (max-width: 1000px) {body {padding: 30px;}
    .ajax-section .cities {grid-template-columns: repeat(3, 1fr);}}
    @media screen and (max-width: 700px) {.heading,.ajax-section .city-temp {font-size: 3rem;}
    .ajax-section {margin-top: 20px;}
    .top-banner form {flex-direction: column;align-items: flex-start;}    
    .top-banner form input,.top-banner form button {width: 100%;}
    .top-banner form button {margin: 20px 0 0 0;}
    .top-banner form .msg {position: static;max-width: none;min-height: 0;margin-top: 10px;}
    .ajax-section .cities { grid-template-columns: repeat(2, 1fr);}}
    @media screen and (max-width: 500px) {body {padding: 15px;}
    .ajax-section .cities { grid-template-columns: repeat(1, 1fr);}}
    .page-footer {text-align: right;font-size: 1rem;color: var(--text_light);margin-top: 40px;}
    .page-footer span {color: var(--red);}
    .api {background: #fffbbc;position: fixed;top: 0;left: 0;width: 100%;padding: 10px}
    .api a {text-decoration: underline;}
    .api a:hover {text-decoration: none;}
</style>

<script>
    /*SEARCH BY USING A CITY NAME (e.g. athens) OR A COMMA-SEPARATED CITY NAME ALONG WITH THE COUNTRY CODE (e.g. athens,gr)*/
    const form = document.querySelector(".top-banner form");
    const input = document.querySelector(".top-banner input");
    const msg = document.querySelector(".top-banner .msg");
    const list = document.querySelector(".ajax-section .cities");
    /*PUT YOUR OWN KEY HERE - THIS MIGHT NOT WORK
    SUBSCRIBE HERE: https://home.openweathermap.org/users/sign_up*/
    const apiKey = "004713410aab1233b5c5e609fe50a1eb";
    
    form.addEventListener("submit", e => {
        e.preventDefault();
        const listItems = list.querySelectorAll(".ajax-section .city");
        const inputVal = input.value;
  
        //ajax here
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${inputVal}&appid=${apiKey}&units=metric`;
        
        fetch(url)
        .then(response => response.json())
        .then(data => {
            const { main, name, sys, weather } = data;
            const icon = `https://openweathermap.org/img/wn/${
                weather[0]["icon"]
            }@2x.png`;
      
            const li = document.createElement("li");
            li.classList.add("city");
            const markup = `
                <h2 class="city-name" data-name="${name},${sys.country}">
                <span>${name}</span>
                <sup>${sys.country}</sup>
                </h2>
                <div class="city-temp">${Math.round(main.temp)}<sup>°C</sup></div>
                <figure>
                <img class="city-icon" src=${icon} alt=${weather[0]["main"]}>
                <figcaption>${weather[0]["description"]}</figcaption>
                </figure>
            `;
            li.innerHTML = markup;
            list.appendChild(li);
        })
        .catch(() => {
            msg.textContent = "Por favor busque una ciudad válida 😩";
        });
        
        msg.textContent = "";
        form.reset();
        input.focus();
    });
</script>