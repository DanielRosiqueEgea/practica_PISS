

<?php
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
include_once("funcionBBDD.php"); 
                    $dblink = db_connect();
                    //queremos que el de ofertas salga si o si, pero el genero queremos que sea aleatorio 
                    //el problema
$generos = array(
    0 => "Accion",
    1 =>  "Terror",
    2 => "Romance",
    3  =>"Aventura",
    4 => "Hack and Slash",
    5 => "Gore",
    6=> "Rogue like",
    7 =>"Shooters",
    8 => "Free to Play",
    9 => "MOBA"
);   
$generoQueSeMuestra = rand(0,9);                 
$sql = array(
    "1"=> "SELECT * FROM videojuegos WHERE OFERTA = 1",
"0" => "SELECT generos.*, generosjuego.*, videojuegos.* FROM generos LEFT JOIN generosjuego ON generosjuego.idGenero = generos.idGenero LEFT JOIN videojuegos ON generosjuego.idJuego = videojuegos.idJuego WHERE generos.nombreGenero=\"".$generos[$generoQueSeMuestra]."\""
);

if(isset($_SESSION['user'])){
    $sql["2"]= "SELECT `videojuegos`.*, `favoritos`.*, `usuarios`.* FROM `videojuegos` LEFT JOIN `favoritos` ON `favoritos`.`idJuego` = `videojuegos`.`idJuego` LEFT JOIN `usuarios` ON `favoritos`.`idUsuario` = `usuarios`.`idUsuario` WHERE`usuarios`.`nickname`=\"".$_SESSION['Usuario']."\"";
    
}

for($i=(count($sql)-1);$i>=0;$i--){
?>


                <?php 
                    $resultado = peticionSQL($sql[$i],$dblink);
                
                    if(mysqli_num_rows($resultado)>1){
                ?>
            <section class="slideshow-container">
                <article>
                        <h2 class="tituloCat"><?php if($i==1)echo "Ofertas";
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
                    <article class="mySlides<?=$i+1?> slide first-child" itemscope itemtype="https://schema.org/Game">
                        <a href="javascript:void(0)" onclick="irAJuego(<?= $juego->idJuego?>)">
                            <?php
                             $sql_imagen = "SELECT * FROM imagenes WHERE idJuego = $juego->idJuego;";
                             $resultado_imagen = peticionSQL($sql_imagen,$dblink);    
                            ?>

                     
                            <img  itemprop="image" src="imagenes/<?=mysqli_fetch_object($resultado_imagen)->urlImagen?>" alt="<?$juego->nombreJuego?>">
                            <strong class="tituloPeq" itemprop="name"><?=$juego->nombreJuego?></strong>
                            <p class="precio" itemprop="price"><?=$juego->precioJuego==0?"Free to Play":$juego->precioJuego."€"?></p>
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
<link rel="stylesheet" type="text/css" href="estilos/slideshow.css">
        <script src="scripts/slideshow.js"></script>