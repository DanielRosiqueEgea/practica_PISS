<?php
        session_start();
       
        if(isset($_GET['accion']) && isset($_GET['idJuego'])){
    
            include_once("phpComponents/funcionBBDD.php");
            $link=db_connect();
            switch ($_GET['accion']){
                case "quitar":
                    $sql ="DELETE FROM favoritos WHERE `favoritos`.`idUsuario` =".$_SESSION['user']." AND `favoritos`.`idJuego` =".$_GET['idJuego'];
                    $alert="Quitado de Favoritos";
                    break;
                case "añadir":
                    $sql= "INSERT INTO `favoritos` (`idUsuario`, `idJuego`) VALUES ('".$_SESSION['user']."', '".$_GET['idJuego']."')";
                    $alert="Añadido Favoritos";    
                    break;
                }
            $resultado=peticionSQL($sql,$link);
            
            echo "<script>alert(\"".$alert."\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    
        
            
            
           
      
        }
        echo "<script>alert(\"Error enviando los datos\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    

    ?>