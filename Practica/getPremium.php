<?php
    
      
    session_start();
    if(!isset($_SESSION['user']) || !isset($_POST['premium']) ){
        echo "<script>alert(\"ERROR\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    
        exit;
    }

    include_once("phpComponents/funcionBBDD.php");
    $link=db_connect();

    
    // Actualizar los datos del usuario
    $sql = "UPDATE usuarios 
    SET premium = '".$_POST['premium']."'WHERE idUsuario = ".$_SESSION['user'];
    $resultado = peticionSQL($sql,$link);

    if($resultado){
        echo "<script>alert(\"Actualización correcta\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";     
        exit;
    }
        
    echo "<script>alert(\"Error al actualizar\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";   
    exit;   

   

    ?>