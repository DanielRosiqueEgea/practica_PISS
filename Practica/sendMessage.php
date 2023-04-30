<?php
// obtener los parámetros enviados por AJAX
if (!headers_sent() && '' == session_id()) {
    session_start();
}

if(!isset($_SESSION['user']) || !isset($_POST['otherUser']) || !isset($_POST['text'])) {
    array_push($messages, array('type' => 'ERROR', 'text' => 'HA HABIDO UN ERROR AL CARGAR LOS DATOS') );
    echo json_encode($messages);
    exit; 
} 

include_once("phpComponents/funcionBBDD.php");
$link = db_Connect();

$sql_chat = "INSERT INTO `mensajechat` (`idSender`, `idReceiver`, `contenido`) 
VALUES ('".$_SESSION['user']."','".$_POST['otherUser']."', '".$_POST['text']."');";
$qry_chat = peticionSQL($sql_chat, $link);

if($qry_chat){
    
    echo "<script>alert(\"Registro Correcto\");</script>";    
    exit;
}

echo "<script>alert(\"ERROR AL ENVIAR EL MENSAJE\");</script>";    


?>




