<?php
// obtener los parámetros enviados por AJAX
$idJuego = $_POST['idJuego'];
$idUsuario = $_POST['idUsuario'];
$puntuacion = $_POST['puntuacion'];
include_once("funcionBBDD.php");
$link = db_Connect();
// realizar la actualización en la base de datos
$sql_actualizar_puntuacion = "UPDATE puntuaciones SET puntuacion = puntuacion + ".$puntuacion." WHERE idJuego=".$idJuego." AND idUsuario=".$idUsuario;
peticionSQL($sql_actualizar_puntuacion, $link);

// obtener la nueva puntuación del usuario
$sql_obtener_puntuacion = "SELECT puntuacion FROM puntuaciones WHERE idJuego=".$idJuego." AND idUsuario=".$idUsuario;
$qry_obtener_puntuacion = peticionSQL($sql_obtener_puntuacion, $link);
$puntuacionUsuario = mysqli_fetch_object($qry_obtener_puntuacion)->puntuacion;

// devolver la nueva puntuación del usuario como respuesta a la petición AJAX
echo $puntuacionUsuario;
?>