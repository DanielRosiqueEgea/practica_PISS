<?php 

    include_once("funcionBBDD.php");
    
    $link = db_Connect();
    $sql = "SELECT * FROM puntuaciones p, usuarios u WHERE p.idJuego =\"" . $_GET['juego']. "\"AND u.idUsuario = p.idUsuario;";
    $resultado = peticionSQL($sql,$link);
    if(!$resultado){
        echo("<h1>ERROR AL MOSTRAR PUNTUACIONES, VUELVA A INTENTARLO EN OTRO MOMENTO</h1>");
    }
    if (mysqli_num_rows($resultado) == 0) {
        echo ("<h1>Parace que no existen juegos que coincidan con la busqueda...</h1>");
    }

    
  

    echo "<script>console.log(\"Numero de filas devueltas".mysqli_num_rows($resultado)."\");</script>";     
    if(mysqli_num_rows($resultado)>=1){
        echo("<table><tr><th  colspan=\"3\" style=\"text-align:center\">Ranking</th></tr>");
        $i = 1;
        echo("<tr><th>\tPOSICION</th><th>\tPUNTUACION</th><th>\tUSUARIO</th></tr>");
        while($puntuacion = mysqli_fetch_object($resultado)){
            echo("<tr>");
            echo("<td>\t".$i."</td>");
            echo("<td>\t".$puntuacion->puntuacion."</td>");
            $eresTu ="";
            if(isset($_SESSION['user']) && ($_SESSION['user'] == $puntuacion->idUsuario)){
                $eresTu = " <<---";
                // echo("<script>console.log(\"USUARIOENCNTRADO\"".$_SESSION['user']."</script>");
            }
            
            
            echo("<td>\t".$puntuacion->nombre.$eresTu."</td>");
            echo("</tr>");
            $i=$i+1;
        }
    }
?>