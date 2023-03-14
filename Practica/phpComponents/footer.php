<link rel="stylesheet" type="text/css" href="estilos/footer.css">
<footer class="footerNav">

<?php
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
include_once("funcionBBDD.php"); 
$dblink1 = db_connect();
                   
$sql1 = "SELECT * FROM equipo";

$resultado = peticionSQL($sql1,$dblink1);
if(mysqli_num_rows($resultado)>=1){
  while($persona = mysqli_fetch_object($resultado)){
?>
 
 <section class="column">
    <article class="card">
      <img src="imagenes/daniRsq.webp" alt="Foto De dani" style="width:100%">
      <span class="container">
        <h2><?=$persona->nombre?></h2>
        <p class="title"><?=$persona->puesto?></p>
        <p><?=$persona->description?></p>
        <a class="button" href = "mailto: <?=$persona->email?>"><?=$persona->email?></a>
   
      </span>
</article>
</section>
<?php }

}?>


</footer>