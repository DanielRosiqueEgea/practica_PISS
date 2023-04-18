<!DOCTYPE html>
<html>

<head>
    <title>Fractal Games Juego</title>
    <?php
    if (!headers_sent() && '' == session_id()) {
        session_start();
    }
    //para volver al index si el usuario  no está logueado
       
    if (!isset($_SESSION['user'])) {
        header("Location: index.php");
        exit;
    }



    include("head.php");
    //include("phpComponents/logo.php"); 
   ?>


<link rel="stylesheet" type="text/css" href="estilos/juego.css">
</head>

<body>
    <?php 
     include("phpComponents/topbar.php");
    include("phpComponents/float_button.php");
    include_once("phpComponents/funcionBBDD.php");
    $link = db_Connect();
    $sql_user = "SELECT * FROM usuarios WHERE usuarios.idUsuario = \"".$_SESSION['user']."\"";
    $resultado = peticionSQL($sql_user,$link);
    $usuario = null;
    
    if (mysqli_num_rows($resultado) >= 0) {
        $usuario = mysqli_fetch_object($resultado);
        
    }else{
        echo ("<h1>Ha Habido un error al cargar los datos de la base de datos, intentelo de nuevo</h1>");
    }

    if($usuario != null){
    ?>
    
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
            <span class="font-weight-bold"><?=$usuario->nickname?></span>
            <span class="text-black-50"><?=$usuario->email?></span>
            <span class="text-black-50"><?=$usuario->fechaNac?></span>
            <span> </span>
        </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Datos del perfil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre</label><input type="text" class="form-control" placeholder="first name" value="<?=$usuario->nombre?>"></div>
                    <div class="col-md-6"><label class="labels">Apellidos</label><input type="text" class="form-control" value="<?=$usuario->apellidos?>" placeholder="surname"></div>
                    
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Contraseña actual</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">Nueva Contraseña</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php 
    }
include("phpComponents/footer.php");?>
</body>