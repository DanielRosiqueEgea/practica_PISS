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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="<?=$usuario->fotoPerfil?>">
            <span class="font-weight-bold"><?=$usuario->nickname?></span>
            <span class="text-black-50"><?=$usuario->email?></span>
            <span class="text-black-50"><?=$usuario->fechaNac?></span>
            
        </div>
        </div>
        
        <div class="col-md-5 border-right">
        <form action="actualizarPerfil.php" method="post">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Datos del perfil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre</label><input name="nombre" type="text" class="form-control" placeholder="first name" value="<?=$usuario->nombre?>" required></div>
                    <div class="col-md-6"><label class="labels">Apellidos</label><input name="apellidos" type="text" class="form-control" value="<?=$usuario->apellidos?>" placeholder="surname" required></div>
                    
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Contraseña actual</label><input name="oldpass" type="password" class="form-control" placeholder="*****" value="" required></div>
                    <div class="col-md-6"><label class="labels">Nueva Contraseña</label><input name="newpass" type="password" class="form-control" value="" placeholder="*****" required></div>
                    <div class="col-md-12"><label class="labels">urlFotoPerfil</label><input name="fotoPerfil" type="url" class="form-control" value="<?=$usuario->fotoPerfil?>" required></div>
                </div>
                <div class="mt-5 text-center"><button type="submit" class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
            </form>
        </div>
        
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Juegos Favoritos</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Juego</span></div><br>
                <?php 
                  $sql_favs= "SELECT `videojuegos`.*, `favoritos`.*, `usuarios`.* FROM `videojuegos` LEFT JOIN `favoritos` ON `favoritos`.`idJuego` = `videojuegos`.`idJuego` LEFT JOIN `usuarios` ON `favoritos`.`idUsuario` = `usuarios`.`idUsuario` WHERE`usuarios`.`idUsuario`=\"".$_SESSION['user']."\"";
                  $resultado = peticionSQL($sql_favs,$link);
                  if(mysqli_num_rows($resultado)>=1){
                    while ($juego = mysqli_fetch_object($resultado)) {
                ?>
                <div class="row">
                    <div class="col-md-8"><?=$juego->nombreJuego?></div>
        
                    <div class="col-md-4"><button onclick="quitarFav(<?=$juego->idJuego?>)" class="btn btn-primary profile-button" ><i class="fa fa-minus" aria-hidden="true"></i></button></div>
                </div>
                <?php
                    }    
            }else{
                    echo "<div class=\"class-md-6\">No tienes juegos favoritos";
                } ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
   
<?php 
    }
include("phpComponents/footer.php");?>

<script>
    
        function quitarFav(idJuego) {
            window.location = "favoritos.php?idJuego=" + idJuego + "&accion=quitar";
        }
    </script>
</body>