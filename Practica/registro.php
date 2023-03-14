<?php
    
            session_start();
        
         $nickBien =(isset($_POST['nickname']));
         $contraseñaBien = (isset($_POST['pass']));
         $emailBien =(isset($_POST['email']));
         $apellidosBien = (isset($_POST['apellidos']));
         $fechaBien =(isset($_POST['fechaNac']));
         $nombreBien =(isset($_POST['nombre']));
       
         
        if($nombreBien && $contraseñaBien && $fechaBien && $nickBien && $emailBien && $apellidosBien){
            include_once("phpComponents/funcionBBDD.php");
            $link=db_connect();
            $sql = "INSERT INTO `usuarios` (`idUsuario`, `nickname`, `nombre`, `apellidos`, `password`, `email`, `fechaNac`) 
            VALUES (NULL, '".$_POST['nickname']."', '".$_POST['nombre']."', '".$_POST['apellidos']."', '".$_POST['pass']."', '".$_POST['email']."', '".$_POST['fechaNac']."')";
            $resultado=peticionSQL($sql,$link);

            if($resultado){
                $_SESSION['Usuario']=$_POST['nombre'];
                
                echo "<script>alert(\"Registro Correcto\"); window.location = \"index.php\";</script>";    
        
            }
            
            echo "<script>alert(\"Registro Incorrecto\"); window.location = \"index.php\";</script>";    
      
        }
        echo "<script>alert(\"Faltan Datos\") </script>";    

    ?>