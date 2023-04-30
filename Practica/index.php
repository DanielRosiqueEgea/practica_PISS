
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
    <?php include("phpComponents/topbar.php")?>

    <section id="banner" class="banner-section"> 
        <?php include("phpComponents/carousel.php")?><br>
    </section>
    <hr id="barra"/>
    <section id="mainContent"> <?php include("phpComponents/slideshow.php")?></section>
    <?php include("phpComponents/footer.php") ?>

</body>


</html>