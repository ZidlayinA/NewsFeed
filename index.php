<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<?php
/* Redireccionamiento a la página principal de noticias */
header("location:noticias/")
?>

</body>
</html>