<!DOCTYPE html>
<html>

<head>
    <title>Fractal Games Catalogo</title>
   
    <?php 
 include("head.php");
  //para volver al index si no se ha incluido parametro de busqueda
//   if(!isset($_GET['genero']) && !isset($_GET['nombre']) && !isset($_GET['consola'])&& !isset($_GET['all'])){
//       header("Location: index.php");
//       exit;
//   }

//   //en funcion de la consulta que queramos hacer hacemos una consulta u otra
//   if(isset($_GET['genero'])){
//   $sql ="SELECT generos.*, generosjuego.*, videojuegos.* FROM generos LEFT JOIN generosjuego ON generosjuego.idGenero = generos.idGenero LEFT JOIN videojuegos ON generosjuego.idJuego = videojuegos.idJuego WHERE generos.idGenero=".$_GET['genero'];
//   }
//   if(isset($_GET['consola'])){
//     $sql ="SELECT consolas.*, consolaJuego.*, videojuegos.* FROM consolas LEFT JOIN consolaJuego ON consolas.idConsola = consolajuego.idConsola LEFT JOIN videojuegos ON consolajuego.idJuego = videojuegos.idJuego WHERE consolas.idConsola=".$_GET['consola'];
//     }
//     if(isset($_GET['nombre'])){
//        $sql="SELECT `videojuegos`.* FROM `videojuegos`
//        WHERE `videojuegos`.`nombreJuego` LIKE '%".$_GET['nombre']."%'"; 
//     }
//     if(isset($_GET['all'])){
//         $sql="SELECT * FROM videojuegos";
//     }

    if (!headers_sent() && '' == session_id()) {
        session_start();
    }
    // include("../../Practica/head.php");
    $sql="SELECT DISTINCT v.idJuego,v.nombreJuego,v.duracion FROM videojuegos AS v";
    $sql = $sql. " LEFT JOIN generosjuego ON generosjuego.idJuego = v.idJuego LEFT JOIN generos ON generosjuego.idGenero = generos.idGenero"; 
    $sql = $sql." LEFT JOIN consolajuego ON v.idJuego = consolajuego.idJuego LEFT JOIN consolas ON consolajuego.idConsola = consolas.idConsola";
    $sql = $sql." WHERE TRUE ";
    if(isset($_POST["genero"])){
        $nombre = $_POST["genero"];
        $sql = $sql. "AND (";
    foreach($nombre as $genero){
        $sql = $sql. " generos.idGenero = \"".$genero."\" OR ";
    }
        $sql = $sql. " FALSE )";
    }
    if(isset($_POST["consola"])){
        $nombre = $_POST["consola"];
        $sql = $sql. "AND (";
    foreach($nombre as $consola){
        $sql = $sql. " consolas.idConsola = \"".$consola."\" OR ";
    }
        $sql = $sql. " FALSE )";
    }
    if(isset($_POST['nombre'])){
        $sql = $sql. " AND ";
        $sql= $sql." v.nombreJuego LIKE '%".$_POST['nombre']."%'"; 
    }

?>     

     
   
</head>

<style>

form {
    margin: 1px 43px;
}
</style>

<body>
<section id="mainContent">
    
        <?php
         
          //include("phpComponents/logo.php"); 
          include("phpComponents/topbar.php");
          include("phpComponents/formularioBusqueda.php");
        
        
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

                     
                            <img  itemprop="image" src="<?=mysqli_fetch_object($resultado_imagen)->urlImagen?>" alt="<?=$juego->nombreJuego?>">
                            <strong class="tituloPeq" itemprop="name"><?=$juego->nombreJuego?></strong>

                            <p class="precio" itemprop="price">
                                <i class="fa-solid fa-heart"></i>
                                <i class="fa-solid fa-chess-board"></i> <!-- tablero -->
                                <i class="fa-solid fa-dice"></i> <!-- dados -->
                                <i class="fa-solid fa-dice-d20"></i> <!-- Rol -->
                                <i class="fa-solid fa-martini-glass-citrus"></i> <!-- PArty games -->
                                <i class="fa-solid fa-chess-pawn"></i> <!-- fichas -->
                                <i class="fa-solid fa-crosshairs"></i> <!-- shooters -->
                                <span class="fa-solid fa-custom-svg" style="font-size: 24px; color: #333;">
                                <img class="fa-solid" src="imagenes/cartas.svg" alt="Descripción del icono SVG">
                                </span>                          
                                </p>
                            <!-- <=$juego->precioJuego==0?"Free to Play":$juego->precioJuego."€"?> -->
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