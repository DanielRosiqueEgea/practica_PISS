<!DOCTYPE html>
<html>

<head>
    <title>Fractal Games Juego</title>
    <?php
     if (!headers_sent() && '' == session_id()) {
        session_start();
    }
    include("head.php");
   ?>

<link rel="stylesheet" type="text/css" href="estilos/juego.css">

</head>

<body>
<?php
 
//para volver al index si el id del juego no está incluido

    include("phpComponents/topbar.php");
    
    ?>
        <section id="mainContent">
    <?php
    include("phpComponents/datos_juego.php");
    
    //include("phpComponents/ranking.php");
    include("phpComponents/gameContainer.php");
    
    ?>
    <br>
       
      
   </section>
   <?php
   include("phpComponents/historial_juego.php");
    include("phpComponents/chat.php");
    
    ?>


   

</body>


</html>