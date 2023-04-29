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
include_once("../../Practica/phpComponents/funcionBBDD.php");
$link = db_Connect();

$sql_chat = "SELECT * FROM mensajechat WHERE (`idSender` = ".$thisUser." AND `idReceiver` = ".$otherUser.") OR (`idSender` = ".$otherUser." AND `idReceiver` = ".$thisUser.") ORDER BY timestamp ASC;";

$qry_chat = peticionSQL($sql_chat, $link);
if (!$qry_chat) {
    array_push($messages, array('type' => 'ERROR', 'text' => 'HA HABIDO UN ERROR AL CARGAR LOS DATOS') );
    echo json_encode($messages);
    exit; 
}

if(mysqli_num_rows($qry_chat)==0){
    array_push($messages, array('type' => 'ERROR', 'text' => 'NO HAY MENSAJES') );
    echo json_encode($messages);
    exit; 
}

while ($mensaje = mysqli_fetch_object($qry_chat)) {
    $type = $_SESSION['user']==$mensaje->idSender?'self':'other';
    array_push($messages,
    array('type'=>$type,
    'text' => $mensaje->contenido
));

}

echo json_encode($messages);



?>
