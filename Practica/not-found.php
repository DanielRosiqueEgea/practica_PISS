<?php
$messages = array(
"Lo sentimos, no pudimos encontrar lo que estás buscando.",
"Oops, parece que hemos perdido ese archivo.",
"¿Estás seguro de que ingresaste la URL correcta?",
"Ese archivo ha sido eliminado o nunca existió.",
);

$message = $messages[array_rand($messages)];

echo "<html><body><h1>Error 404</h1><p>$message</p></body></html>";
?>

