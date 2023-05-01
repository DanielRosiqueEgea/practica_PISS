
<?php

if (!headers_sent() && '' == session_id()) {
    session_start();
}
if (!isset($_GET['juego'])) {
    echo("HA HABIDO UN ERROR AL ACCEDER A LA PAGINA");
    echo("VUELVE AL INICIO E INTENALO DE NUEVO");
    exit;
}
    include_once("phpComponents/funcionBBDD.php");
    $link = db_Connect();
    $favbutton ="";
    $funcion = "document.getElementById('id01').style.display='block'";
   
    $actualizar_puntuacion ="";
    $display_puntuacion = "";

    $duracion = array(
        "1" =>"Corta",
        "2" =>"Media",
        "3" => "Larga",
        "4" => "Muy Larga"
    );

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
                            <img src="<?= $imagen->urlImagen ?>" class="imgJuegoPhp" alt="slide<?= $j ?>">
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
            <?php if(!isset($duracion[$juego->duracion])){
                $iconoDuracion ="No disponible";
            }else{
                $iconoDuracion =$duracion[$juego->duracion];
            } ?>
            <h3 style="display:block"><i class="fa-regular fa-clock"></i><?=$iconoDuracion?></h3>
            <p class="descriptionContainer"> <br><?= $juego->descripcionJuego ?>
            </p>
        </article>
       