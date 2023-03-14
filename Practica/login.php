<?php
    
        session_start();
        
         $nombreBien =(isset($_POST['nombre']));
         $contraseñaBien = (isset($_POST['pass']));
         
        if($nombreBien && $contraseñaBien){
            include_once("phpComponents/funcionBBDD.php");
            $link=db_connect();
            $sql = "SELECT * FROM USUARIOS WHERE USUARIOS.nickname=\"".$_POST['nombre']."\"";
            $resultado=peticionSQL($sql,$link);
            $usuario =mysqli_fetch_object($resultado);


            if(!strcmp($usuario->password,$_POST['pass'])){
                $_SESSION['user']=$usuario->idUsuario;
                $_SESSION['Usuario']=$usuario->nickname;
                echo "<script>alert(\"Login Correcto\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    
        
            }
            
            echo "<script>alert(\"Login Incorrecto\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    
      
        }
        echo "<script>alert(\"Error enviando los datos\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    

    ?>