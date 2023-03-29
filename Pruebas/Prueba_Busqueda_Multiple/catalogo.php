<!DOCTYPE html>
<html>

<head>
    <title>Fractal Games Catalogo</title>
    
    <?php 
    // include("../../Practica/head.php");
    $sql="SELECT DISTINCT v.idJuego,v.nombreJuego,v.precioJuego FROM videojuegos AS v";
    $sql = $sql. " LEFT JOIN generosjuego ON generosjuego.idJuego = v.idJuego LEFT JOIN generos ON generosjuego.idGenero = generos.idGenero"; 
    $sql = $sql." LEFT JOIN consolajuego ON v.idJuego = consolajuego.idJuego LEFT JOIN consolas ON consolajuego.idConsola = consolas.idConsola";
    $sql = $sql." WHERE TRUE ";
    if(isset($_POST["genero"])){
        $nombre = $_POST["genero"];
        $sql = $sql. "AND";
    foreach($nombre as $genero){
        $sql = $sql. " generos.nombreGenero = \"".$genero."\" OR ";
    }
        $sql = $sql. " FALSE ";
    }
    if(isset($_POST["consola"])){
        $nombre = $_POST["consola"];
        $sql = $sql. "AND";
    foreach($nombre as $consola){
        $sql = $sql. " consola.nombreConsola = \"".$consola."\" OR ";
    }
        $sql = $sql. " FALSE";
    }

    
?>     
   
</head>

<body>
<section id="mainContent">
    
        <?php
            include("formulario.php");
          echo "<br>".$sql."</br>";
        
         
          include_once("../../Practica/phpComponents/funcionBBDD.php");
        $link = db_Connect();
        
                    $resultado = peticionSQL($sql,$link);
                    if(!$resultado){
                        echo("ERROR AL MOSTRAR JUEGO, VUELVA A INTENTARLO EN OTRO MOMENTO");
                    }
                    if (mysqli_num_rows($resultado) == 0) {
                        echo ("<h1>Parace que no existen juegos que coincidan con la busqueda...</h1>");
                    }
                    echo "<script>console.log(\"Numero de filas devueltas".mysqli_num_rows($resultado)."\");</script>";     
                    if(mysqli_num_rows($resultado)>=1){
                ?>
                  <article>
                        <h2 class="tituloCat">Catalogo</h2>
                </article>

               <?php
               $i=0;
                    while ($juego = mysqli_fetch_object($resultado)) {
                    if($i%4==0){
                        echo "<section class=\"slideshow-container\">";
                    }
                    ?>
                    <article class="slide" itemscope itemtype="https://schema.org/Game">
                        <a href="juego.php?juego=<?=$juego->idJuego?>">
                            <?php
                             $sql_imagen = "SELECT * FROM imagenes WHERE idJuego = $juego->idJuego;";
                             $resultado_imagen = peticionSQL($sql_imagen,$link);    
                            ?>

                     
                            <!-- <img  itemprop="image" src="imagenes/<=mysqli_fetch_object($resultado_imagen)->urlImagen?>" alt="<=$juego->nombreJuego?>"> -->
                            <strong class="tituloPeq" itemprop="name"><?=$juego->nombreJuego?></strong>
                            <p class="precio" itemprop="price"><?=$juego->precioJuego==0?"Free to Play":$juego->precioJuego."€"?></p>
                        </a>
                    </article>
                    
                    <?php if($i%4==3) echo "</section>";
                        $i++; 
                    } 
                        
                    ?>

<br>
<?php }?>
            
            </section>
            <!-- <php include("phpComponents/footer.php")?>
            <link rel="stylesheet" type="text/css" href="estilos/slideshow.css"> -->
</body>
</html>
<!-- https://stackoverflow.com/questions/18421988/getting-checkbox-values-on-submit -->