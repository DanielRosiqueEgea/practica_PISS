<?php 
     if (!headers_sent() && '' == session_id()) {
        session_start();
    }
    if (!isset($_GET['juego'])) {
        echo("HA HABIDO UN ERROR AL ACCEDER A LA PAGINA");
        echo("VUELVE AL INICIO E INTENALO DE NUEVO");
        exit;
    }
    
    include_once("funcionBBDD.php");
    
    $link = db_Connect();
    $sql = "SELECT * FROM puntuaciones p, usuarios u WHERE p.idJuego =\"" . $_GET['juego']. "\"AND u.idUsuario = p.idUsuario;";
    $resultado = peticionSQL($sql,$link);
    if(!$resultado){
        echo "<h1>ERROR AL MOSTRAR PUNTUACIONES, VUELVA A INTENTARLO EN OTRO MOMENTO</h1>";
    }
    if (mysqli_num_rows($resultado) == 0) {
        echo "<h1>Parace que no existen juegos que coincidan con la busqueda...</h1>";
    exit;
    }

    
    ?>
    
    
<table>
    <tr>
        <th  colspan="3" style="text-align:center;">Ranking</th>
    </tr>
    <tr>
        <th> POSICION </th>
        <th> PUNTUACION </th>
        <th> USUARIO </th>
    </tr>
  <?php
    $i = 1;
    
        while($puntuacion = mysqli_fetch_object($resultado)){
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>".$puntuacion->puntuacion."</td>";
            $eresTu ="";
            if(isset($_SESSION['user']) && ($_SESSION['user'] == $puntuacion->idUsuario)){
                $eresTu = " <<---";
            }
            
            echo "<td>".$puntuacion->nombre.$eresTu."</td>";
            echo "</tr>";
            $i=$i+1;
        }
?>
</table>