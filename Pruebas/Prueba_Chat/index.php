
<!DOCTYPE html>
<html>
<?php session_start();?>
<head>

    <title>Fractal Games</title>
    <?php include("head.php"); ?>
    </head>


<body>
<!--php 
include("phpComponents/logo.php"); ?-->     
    <?php include("../../Practica/phpComponents/topbar.php")?>
    <?php include("chat.php")?>
    <?php include("pruebaHistorialFlotante.php")?>
    <section id="mainContent"> <?php include("../../Practica/phpComponents/slideshow.php")?></section>
    <?php include("../../Practica/phpComponents/footer.php") ?>

</body>


</html>