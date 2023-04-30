<?php
// obtener los parámetros enviados por AJAX
if (!headers_sent() && '' == session_id()) {
    session_start();
}
$messages = array();
if(!isset($_SESSION['user']) || !isset($_GET['otherUser'])) {
    array_push($messages, array('type' => 'ERROR', 'text' => 'HA HABIDO UN ERROR AL CARGAR LOS DATOS') );
    echo json_encode($messages);
    exit; 
} 
$thisUser =intval($_SESSION['user']);
$otherUser = intval($_GET['otherUser']);
include_once("phpComponents/funcionBBDD.php");
$link = db_Connect();

$sql_chat = "SELECT * FROM mensajechat WHERE (`idSender` = ".$thisUser." AND `idReceiver` = ".$otherUser.") OR (`idSender` = ".$otherUser." AND `idReceiver` = ".$thisUser.") ORDER BY timestamp ASC;";

$qry_chat = peticionSQL($sql_chat, $link);
if (!$qry_chat) {
    array_push($messages, array('type' => 'ERROR','url'=>"", 'text' => 'HA HABIDO UN ERROR AL CARGAR LOS DATOS') );
    echo json_encode($messages);
    exit; 
}

if(mysqli_num_rows($qry_chat)==0){
    array_push($messages, array('type' => 'ERROR','url'=>"", 'text' => 'NO HAY MENSAJES') );
    echo json_encode($messages);
    exit; 
}

while ($mensaje = mysqli_fetch_object($qry_chat)) {
    $type = $_SESSION['user']==$mensaje->idSender?'self':'other';
    $sql_user = "SELECT * FROM usuarios WHERE idUsuario=".$mensaje->idSender."";
    $qry_user= peticionSQL($sql_user, $link);  
    $usuario = mysqli_fetch_object($qry_user);
    array_push($messages,
    array('type'=>$type,'url' =>$usuario->fotoPerfil,
    'text' => $mensaje->contenido
));

}

echo json_encode($messages);



?>
