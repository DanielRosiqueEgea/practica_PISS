
<link rel="stylesheet" type="text/css" href="estilos/slideshow.css">
<?php
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
include_once("funcionBBDD.php"); 
$dblink = db_connect();
                    //queremos que el de ofertas salga si o si, pero el genero queremos que sea aleatorio 
                    //el problema

$resultado = peticionSQL("SELECT * FROM generos", $dblink);
$generos = array();
$contador_Genero  = 0;
while ($fila = mysqli_fetch_assoc($resultado)) {
    $generos[$contador_Genero] = $fila['nombreGenero'];
    $contador_Genero+=1;
}
$generoQueSeMuestra = rand(0,$contador_Genero-1);                 
$sql = array(
    "1"=> "SELECT * FROM videojuegos WHERE ROTACION = 1",
"0" => "SELECT generos.*, generosjuego.*, videojuegos.* FROM generos LEFT JOIN generosjuego ON generosjuego.idGenero = generos.idGenero LEFT JOIN videojuegos ON generosjuego.idJuego = videojuegos.idJuego WHERE generos.nombreGenero=\"".$generos[$generoQueSeMuestra]."\""
);

if(isset($_SESSION['user'])){
    $sql["2"]= "SELECT `videojuegos`.*, `favoritos`.*, `usuarios`.* FROM `videojuegos` LEFT JOIN `favoritos` ON `favoritos`.`idJuego` = `videojuegos`.`idJuego` LEFT JOIN `usuarios` ON `favoritos`.`idUsuario` = `usuarios`.`idUsuario` WHERE`usuarios`.`nickname`=\"".$_SESSION['Usuario']."\"";
    
}

$duracion = array(
    "1" =>"Corta",
    "2" =>"Media",
    "3" => "Larga",
    "4" => "Muy Larga"
);

for($i=(count($sql)-1);$i>=0;$i--){
?>


                <?php 
                    $resultado = peticionSQL($sql[$i],$dblink);
                
                    if(mysqli_num_rows($resultado)>=1){
                ?>
            <section class="slideshow-container">
                <article>
                        <h2 class="tituloCat"><?php if($i==1)echo "Rotación";
                        elseif($i==2) echo "Favoritos"; else echo ($generos[$generoQueSeMuestra]); ?></h2>
                </article>
                <?php if(mysqli_num_rows($resultado)>4){ ?>
                <article class="slideBtnPrev ">
                        <a class="prev" onclick="plusSlides(-1, <?=$i?>)">&#10094;</a>
                     
                </article>
                <?php } ?>
               <?php
                    while ($juego = mysqli_fetch_object($resultado)) {
        
                    ?>
                    <article class="mySlides<?=$i+1?> slide first-child tarjetaJuego" itemscope itemtype="https://schema.org/Game">
                    <a href="javascript:void(0)" onclick="irAJuego(<?= $juego->idJuego?>)">
                            <?php
                             $sql_imagen = "SELECT * FROM imagenes WHERE idJuego = $juego->idJuego;";
                             $resultado_imagen = peticionSQL($sql_imagen,$dblink);    
                            ?>

                            <div  style="position:relative;">
                            <img  itemprop="image" src="<?=mysqli_fetch_object($resultado_imagen)->urlImagen?>" alt="<?=$juego->nombreJuego?>">
                            <?php 
                            if($juego->rotacion){
                            ?>
                            <span class="fa-stack" title="Rotación" style="font-size:30px; position: absolute; bottom: 1%; right: 2%;" >
                            <!-- <i class="fa-solid fa-triangle-exclamation fa-stack-1x" style="font-size:50px; color: red; "></i>
                            <i class="fa-solid fa-triangle-exclamation fa-stack-1x" style="font-size:40px; color: white;"></i> -->
                            <i class="fa-solid fa-circle fa-stack-1x" style="color: white ;"></i>
                                <i class="fa-solid fa-dollar-sign fa-stack-1x" style="font-size: 20px;"></i>
                                <i class="fa-solid fa-ban fa-stack-1x" style="color:red;"></i>
                            </span>    
                            <?php }?>
                    </div>
                            <!-- onerror="this.src='imagenes/img_not_found.webp';" -->
                            <strong class="tituloPeq" itemprop="name"><?=$juego->nombreJuego?></strong>
                            <?php if(!isset($duracion[$juego->duracion])){
                             $iconoDuracion ="No disponible";
                             }else{
                                 $iconoDuracion =$duracion[$juego->duracion];
                             } ?>
                            <p class="precio" itemprop="duration"><i class="fa-regular fa-clock"></i><?=$iconoDuracion?></p>
                        </a>

                    </article>
                    <?php } if(mysqli_num_rows($resultado)>4){?>
                    <article class="slideBtnNext">
                        <a class="next" onclick="plusSlides(1, <?=$i?>)">&#10095;</a>
                    </article>  
                    <?php }?>
</section>
<br>
<?php }}?>

<script src="scripts/slideshow.js"></script>