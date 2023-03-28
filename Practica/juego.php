<!DOCTYPE html>
<html>

<head>
    <title>Fractal Games Juego</title>
    <?php
    if (!headers_sent() && '' == session_id()) {
        session_start();
    }
    //para volver al index si el id del juego no está incluido
    if (!isset($_GET['juego'])) {
        header("Location: index.php");
        exit;
    }


    include("head.php");
    include("phpComponents/logo.php"); 
   ?>


<link rel="stylesheet" type="text/css" href="estilos/juego.css">
</head>

<body>

<?php
    include_once("phpComponents/funcionBBDD.php");
    include("phpComponents/topbar.php");
    include("phpComponents/float_button.php");
    $link = db_Connect();
    $favbutton ="";
    $funcion = "document.getElementById('id01').style.display='block'";
    $ocultar_juego = "document.getElementsByClassName('videoContainer')[0].innerHTML = '<h2>TIENES QUE INICIAR SESION PARA JUGAR</h2>'";
    $actualizar_puntuacion ="";
    $display_puntuacion = "";
    if (isset($_SESSION['user'])) {

        $sql_fav = "SELECT * FROM FAVORITOS WHERE idJuego=" . $_GET['juego'] . " && idUsuario=" . $_SESSION['user'];
        $qry_fav = peticionSQL($sql_fav, $link);
        if (mysqli_num_rows($qry_fav) == 1) {
            $favbutton = "<button onclick=\"quitarFav(" . $_GET['juego'] . ")\" class=\"botonFav\">QuitarFav</button>";
        } else {
            $favbutton = "<button onclick=\"añadirFav(" . $_GET['juego'] . ")\" class=\"botonFav\">AñadirFav</button>";
        }
        
        $ocultar_juego = "";
        $funcion = "alert('Ahora podrá jugar al juego sin problemas')";
      
        $actualizar_puntuacion = "
        var last_score = 0;
        var score =0;
        window.addEventListener('message', function (event) {
            // verificar si el mensaje es del tipo 'scoreUpdate'
            if (event.data.type === 'scoreUpdate') {
                console.log(\"SE ACTUALIZA LA PUNTUACION\")

                // actualizar el contador con el valor enviado por la página dentro del iframe
                var score = event.data.score;

                // código para actualizar el contador en la página principal
                var contador = document.getElementById('score');
                var last_score = parseInt(contador.textContent.match(/\d+/)[0]);

                contador.textContent = \"Score: \" + score;

                

            }
       

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // actualizar la puntuación del usuario en la página
                var puntuacionUsuario = document.getElementById('puntuacion-usuario');
                puntuacionUsuario.textContent = \"Puntuación total: \" + this.responseText;
            }
        };

        xmlhttp.open(\"POST\", \"phpComponents/actualizar_puntuacion.php\", true);
        xmlhttp.setRequestHeader(\"Content-type\", \"application/x-www-form-urlencoded\");
        if (last_score > score) {
            score = score - last_score;
            console.log(\"Ha disminuido tu puntuacion en: \" + score + \" Puntos\");
        }

        xmlhttp.send(\"idJuego=".$_GET['juego']."&idUsuario=".$_SESSION['user']."&puntuacion=\" + score);
    });

        ";
        $sql_puntuacion = "SELECT * FROM puntuaciones WHERE idJuego=".$_GET['juego']." && idUsuario=".$_SESSION['user'];
        $qry_puntuacion = peticionSQL($sql_puntuacion, $link);
        
        if (mysqli_num_rows($qry_puntuacion) < 1) {

            $sql_crear_puntuacion = "INSERT INTO puntuaciones VALUES (".$_SESSION['user'].",".$_GET['juego'].", 0)";
            peticionSQL($sql_crear_puntuacion, $link);
            $qry_puntuacion = peticionSQL($sql_puntuacion, $link);
        }
        $puntuacion = mysqli_fetch_object($qry_puntuacion);
        $display_puntuacion = "<h2 style=\"display: inline; padding-left: 10%;\" id=\"puntuacion-usuario\">Puntuacion total: ".$puntuacion->puntuacion."</h2>"
    ?>

    <script>
        function añadirFav(idJuego) {
            window.location = "favoritos.php?idJuego=" + idJuego + "&accion=añadir";
        }

        function quitarFav(idJuego) {
            window.location = "favoritos.php?idJuego=" + idJuego + "&accion=quitar";
        }
    </script>

    <?php
    }
    ?>
  

    <section id="mainContent">
        <?php
        // include("phpComponents/formLogin.php");
       
        $sql_juego = "SELECT * FROM videojuegos WHERE idJuego =\"" . $_GET['juego'] . "\"";
        $qry_juego = peticionSQL($sql_juego, $link);
        if (!$qry_juego) {
            echo ("ERROR AL MOSTRAR JUEGO, VUELVA A INTENTARLO EN OTRO MOMENTO");
        }
        $juego = mysqli_fetch_object($qry_juego);
        ?>
        <article class="gameContainer">

            <div id="carouselId" class="carousel slide" data-ride="carousel">
                <?PHP
                $sql_imagenes = "SELECT * FROM `imagenes` WHERE idJuego=" . $juego->idJuego;
                $qry_imagenes = peticionSQL($sql_imagenes, $link);
                ?>

                <div class="carousel-inner" role="listbox">
                    <?php
                    $j = 0;
                    while ($imagen = mysqli_fetch_object($qry_imagenes)) { ?>

                        <div class="carousel-item <?= $j == 0 ? "active" : "" ?>">
                            <img src="imagenes/<?= $imagen->urlImagen ?>" class="imgJuegoPhp" alt="slide<?= $j ?>">
                        </div>
                        <?php $j++;
                    } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
               
                <button onclick="<?= $funcion ?>" class="botonJugar">Jugar </button>
                <?php
                    echo $favbutton;
                ?>
            </div>
            <h2 style="float: left; width: 50%;"><?= $juego->nombreJuego ?></h2>
            <h3 style="display:block">Precio: <?= $juego->precioJuego ?>€</h3>
            <p class="descriptionContainer"> <br><?= $juego->descripcionJuego ?>
            </p>
        </article>
        <br>
        <h1>JUEGO</h1>
        <article class="videoContainer">


            <?php if ($juego->trailer != "not available") { ?>


                <h2 style="display: inline;" id="score">Score: 0</h2>

                <?= $display_puntuacion ?>


                <iframe src="<?= $juego->trailer ?>" width="100%" height="750"></iframe>
                <script>
                console.log("Hola")
                <?=$actualizar_puntuacion?>
                <?=$ocultar_juego?>
                </script>
                <?php include("phpComponents/ranking.php"); ?> 
            <?php } else { ?>
                <div> NO DISPONIBLE</div>


            <?php } ?>



        
        </article>
    </section>

                
 


</body>

</html>