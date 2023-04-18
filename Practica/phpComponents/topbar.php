<link href="estilos/topbar.css" rel="stylesheet">
<script>function cerrarSesion(){
    if(confirm("¿Estás de acuerdo con cerrar sesión?")){
        window.location="cerrarSesion.php";
    }
} </script>




<nav class="navbar">
    <!--Enlace a las opciones-->
    <a href="#" class="enlaceHover" id="topbarIzq" onclick="openNav()" ><i class="fa-solid fa-bars fa-2xl" ></i></a>
    
    <!--Parte central-->
    <a href="index.php" class="mx-auto"> <img class="animada" onmouseover="animarFractal(this)" onmouseout="detenerFractal(this)" src="imagenes/fractalLogo.jpg" weight=100 height="100"></a> 


    <!--Enlaces de sesion-->
    <?php if(isset($_SESSION['user'])){
        $funcion = "javascript:void(cerrarSesion())";
         echo "<a href=\"#\" class=\"split\"><i class=\"fa-solid fa-circle-user fa-2xl\" style=\"color: #000000;\"></i></a> ";
    }else{
        $funcion ="javascript:void(document.getElementById('id01').style.display='block')";
    }
    ?>

    
   
    <!--Falta el enlace hacia el perfil^-->


    <a href="<?= $funcion?>" class="split"><i class="fa-solid fa-power-off fa-2xl" style="color: #000000"></i></a>
    
    
</nav>

<!--
<nav class="navbar">
    <!--Parte central->
    <a href="index.php" class="mx-auto"> <img class="animada" onmouseover="animarFractal(this)" onmouseout="detenerFractal(this)" src="imagenes/fractalLogo.jpg" weight=100 height="100"></a> 
</nav>
-->

<script>
		function animarFractal(element) {
			element.setAttribute('src',"imagenes/FractalGif.gif");
      
		}

		function detenerFractal(element) {
			element.setAttribute('src',"imagenes/FractalLogo.jpg");
		}
    
</script>

<?php include("sidepanel.php") ?>
<?php include("formLogin.php") ?> 
