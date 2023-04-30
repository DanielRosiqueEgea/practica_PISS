<?php
    
      
    session_start();
    if(!isset($_SESSION['user'])){
        echo "<script>alert(\"ERROR\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    
        exit;
    }
    if(!isset($_POST['oldpass']) || !isset($_POST['apellidos']) || !isset($_POST['nombre']) 
    || !isset($_POST['newpass']) || !isset($_POST['fotoPerfil'])){
   
    echo "<script>alert(\"Faltan Datos\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>"; 
    exit;   
}

    include_once("phpComponents/funcionBBDD.php");
    $link=db_connect();

    // Obtener la contraseña actual del usuario
    $sql = "SELECT password FROM usuarios WHERE idUsuario = ".$_SESSION['user'];
    $resultado = mysqli_query($link, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $contrasenaActual = $fila['password'];
    

    $imageInfo = getimagesize($_POST['fotoPerfil']);
    if($imageInfo == false) {
        echo "<script>alert(\"LA IMAGEN DE PERFIL NO SE PUEDE CARGAR\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>"; 
        exit;  
    }

    // Verificar que la contraseña proporcionada coincide con la contraseña actual almacenada
    echo "<script>alert(\"Contraseña antigua: ".$_POST['oldpass']." Contraseña actual: ".$contrasenaActual."\");</script>"; 
   
    if($_POST['oldpass'] == $contrasenaActual){
        
        // Actualizar los datos del usuario
        $sql = "UPDATE usuarios 
        SET nombre = '".$_POST['nombre']."', 
        apellidos = '".$_POST['apellidos']."', 
        password = '".$_POST['newpass']."'
        , fotoPerfil = '".$_POST['fotoPerfil']."'
        WHERE idUsuario = ".$_SESSION['user'];
        $resultado = peticionSQL($sql,$link);

        if($resultado){
            echo "<script>alert(\"Actualización correcta\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";     
            exit;
        }
           
        echo "<script>alert(\"Error al actualizar\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";   
        exit;   
        
    }else{
        echo "<script>alert(\"Contraseña incorrecta\"); window.location = \"".$_SERVER['HTTP_REFERER']."\";</script>";    
        
    }
   

    ?>