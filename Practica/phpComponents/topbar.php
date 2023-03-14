<link href="estilos/topbar.css" rel="stylesheet">
<script>function cerrarSesion(){
    if(confirm("¿Estás de acuerdo con cerrar sesión?")){
        window.location="cerrarSesion.php";
    }
} </script>
<nav class="topnav">
    <a href="#" class=" enlaceHover" id="topbarIzq" onclick="openNav()"><i class="fa fa-bars"></i></a>
    <a href="index.php"> FRACTAL GAMES</a>
    <?php if(isset($_SESSION['user'])){
        $funcion = "javascript:void(cerrarSesion())";
    }else{
        $funcion ="javascript:void(document.getElementById('id01').style.display='block')";
    }
    ?>
    <a href="<?= $funcion?>" class="split"><i class='fas fa-power-off'></i></a>
    <a href="index.php" class="split"><i class="fa-solid fa-house"></i></a>
</nav>

<?php include("sidepanel.php") ?>
<?php include("formLogin.php") ?> 
