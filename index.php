<?php

include "configs/config.php";
include "configs/abrirBD.php";
include "configs/funciones.php";

if(!isset($p)){
    $p="inicio";
}else{
    $p = $p;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/estilos.css">
    <!--<link rel="stylesheet" href="bootstrap/css/bootstrap.css">-->
    <!--<link rel="stylesheet" href="fontawesome/css/all.css">-->
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="fontawesome/js/all.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Games</title>
</head>

<body>
    <header>
        <div class="contenedor">
            <h1 class="icon-gamepad">Games</h1>
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu">
                <a href="?p=inicio">Inicio</a>
                <a href="?p=juegos">Juegos</a>
                <a href="?p=ofertas">Ofertas</a>
                <a href="?p=carrito">Carrito</a>
                <?php
                if(!isset($_SESSION['k_id'])){
                ?>
                <a href="?p=ingresar">Ingresar</a>
                <?php
                }
                ?>
                <?php
                if(isset($_SESSION['k_id'])){
                ?>
                <a href="?p=compras">Usuario: <?=nombre_cliente($_SESSION['k_id'])?></a>
                <a href="?p=salir" id="ocultar">Salir</a>
                <?php
                }
                ?>
            </nav>
        </div>
    </header>
    <div class="cuerpo">
        <main>
            
            <?php
                if(file_exists("modulos/".$p.".php")){
                    include "modulos/".$p.".php";
                }else{
                    echo "<i>No se ha encontrado el modulo <b>".$p."<b> <a href='./'>Regresar</a></i>";
                }
            ?>
           
        </main>
    </div>

    <footer>
        <div class="contenedor">
            <p class="copy">Games &copy; 2020</p>
            <div class="sociales">
                <a class="icon-facebook-official" href="#"></a>
                <a class="icon-twitter" href="#"></a>
                <a class="icon-instagram" href="#"></a>
                <a class="icon-gplus-squared" href="#"></a>

            </div>
        </div>
    </footer>

</body>

</html>