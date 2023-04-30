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




?>

        

        <!--Vista del juego-->
        <article class="videoContainer">
       <?php
        if(!isset($_SESSION['user'])){
            echo "<h2>TIENES QUE INICIAR SESiÓN PARA JUGAR</h2>";
        exit;
            }?>

            <?php
            $sql_juego = "SELECT * FROM videojuegos WHERE idJuego =\"" . $_GET['juego'] . "\"";
            $qry_juego = peticionSQL($sql_juego, $link);
            if (!$qry_juego) {
                echo ("ERROR AL MOSTRAR JUEGO, VUELVA A INTENTARLO EN OTRO MOMENTO");
            }
            $juego = mysqli_fetch_object($qry_juego);
            
            if ($juego->urlJuego != "not available") { ?>


                <h2 style="display: inline;" id="score">Puntos partida actual: 0</h2>
                
                <?php
                if(isset($_SESSION['user'])){
                    $sql_puntuacion = "SELECT * FROM puntuaciones WHERE idJuego=".$_GET['juego']." && idUsuario=".$_SESSION['user'];
                    $qry_puntuacion = peticionSQL($sql_puntuacion, $link);
                    
                    if (mysqli_num_rows($qry_puntuacion) < 1) {
            
                        $sql_crear_puntuacion = "INSERT INTO puntuaciones VALUES (".$_SESSION['user'].",".$_GET['juego'].", 0)";
                        peticionSQL($sql_crear_puntuacion, $link);
                        $qry_puntuacion = peticionSQL($sql_puntuacion, $link);
                    }
                    $puntuacion = mysqli_fetch_object($qry_puntuacion);

                    echo "<h2 style=\"display: inline; padding-left: 10%;\" id=\"puntuacion-usuario\">Puntuacion total: ".$puntuacion->puntuacion."</h2>";
                }
                  ?>


                <iframe src="<?= $juego->urlJuego ?>" width="100%" height="750"></iframe>
               
               
            <?php } else { ?>
                <div> NO DISPONIBLE</div>


            <?php } ?>


        <?php if(isset($_SESSION['user'])){ ?>
        <script> 
    
        
        var last_score = 0;
        var score =0;
        window.addEventListener('message', function (event) {
            // verificar si el mensaje es del tipo 'scoreUpdate'
            if (event.data.type === 'scoreUpdate') {
                // console.log("SE ACTUALIZA LA PUNTUACION");

                // actualizar el contador con el valor enviado por la página dentro del iframe
                var score = event.data.score;

                // código para actualizar el contador en la página principal
                var contador = document.getElementById('score');
                var last_score = parseInt(contador.textContent.match(/\d+/)[0]);
                
                contador.textContent = "Score: " + score;

                

            }
       

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // actualizar la puntuación del usuario en la página
                var puntuacionUsuario = document.getElementById('puntuacion-usuario');
                puntuacionUsuario.textContent = "Puntuación total: " + this.responseText;
            }
        };

        xmlhttp.open("POST", "phpComponents/actualizar_puntuacion.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if (last_score > score) {
            score = score - last_score;
            // console.log("Ha disminuido tu puntuacion en: " + score + " Puntos");
        }

        xmlhttp.send("idJuego=<?=$_GET['juego']?>&idUsuario=<?=$_SESSION['user']?>&puntuacion=" + score);
    });

        
    
    </script>
    <?php }?>
        </article>
        <!-- <php include("phpComponents/ranking.php"); ?>  -->
