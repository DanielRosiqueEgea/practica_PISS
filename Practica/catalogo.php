<!DOCTYPE html>
<html>

<head>
    <title>Fractal Games Catalogo</title>
    
    <?php 

  //para volver al index si no se ha incluido parametro de busqueda
  if(!isset($_GET['genero']) && !isset($_GET['nombre']) && !isset($_GET['consola'])&& !isset($_GET['all'])){
      header("Location: index.php");
      exit;
  }
  //en funcion de la consulta que queramos hacer hacemos una consulta u otra
  if(isset($_GET['genero'])){
  $sql ="SELECT generos.*, generosjuego.*, videojuegos.* FROM generos LEFT JOIN generosjuego ON generosjuego.idGenero = generos.idGenero LEFT JOIN videojuegos ON generosjuego.idJuego = videojuegos.idJuego WHERE generos.idGenero=".$_GET['genero'];
  }
  if(isset($_GET['consola'])){
    $sql ="SELECT consolas.*, consolaJuego.*, videojuegos.* FROM consolas LEFT JOIN consolaJuego ON consolas.idConsola = consolajuego.idConsola LEFT JOIN videojuegos ON consolajuego.idJuego = videojuegos.idJuego WHERE consolas.idConsola=".$_GET['consola'];
    }
    if(isset($_GET['nombre'])){
       $sql="SELECT `videojuegos`.* FROM `videojuegos`
       WHERE `videojuegos`.`nombreJuego` LIKE '%".$_GET['nombre']."%'"; 
    }
    if(isset($_GET['all'])){
        $sql="SELECT * FROM videojuegos";
    }

?>     
   
</head>

<body>
<section id="mainContent">
    
        <?php
          include("head.php");
          include("phpComponents/logo.php"); 
          include("phpComponents/topbar.php");
          //include("phpComponents/slideshow.php");
        
        
          include_once("phpComponents/funcionBBDD.php");
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

                     
                            <img  itemprop="image" src="imagenes/<?=mysqli_fetch_object($resultado_imagen)->urlImagen?>" alt="<?=$juego->nombreJuego?>">
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
            <?php include("phpComponents/footer.php")?>
            <link rel="stylesheet" type="text/css" href="estilos/slideshow.css">
</body>
</html>