<link href="estilos/topbar.css" rel="stylesheet">
<script>function cerrarSesion(){
    if(confirm("¿Estás de acuerdo con cerrar sesión?")){
        window.location="cerrarSesion.php";
    }
} </script>




<nav class="navbar">
    <a href="#" style="color: black;" class=" enlaceHover" id="topbarIzq" onclick="openNav()"><i class="fa fa-bars"></i></a>
    
    
    <!--Parte central-->
    <a href="index.php" class="mx-auto"> <img class="animada" onmouseover="animarFractal(this)" onmouseout="detenerFractal(this)" src="imagenes/fractalLogo.jpg" weight=100 height="100"></a> 


    <!--Enlaces de cerrar sesion-->
    <?php if(isset($_SESSION['user'])){
        $funcion = "javascript:void(cerrarSesion())";
    }else{
        $funcion ="javascript:void(document.getElementById('id01').style.display='block')";
    }
    ?>

    
    <a href="<?= $funcion?>" class="split"><i class='fas fa-power-off' style=""></i></a>
    <a href="index.php" class="split"><i class="fa-solid fa-house"></i></a>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Logo</a>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Left Button</a>
        hola
      </li>
    </ul>
    <div class="mx-auto">
      <a class="navbar-brand" href="#">Centrado</a>
    </div>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Right Button 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Right Button 2</a>
      </li>
    </ul>
  </div>
</nav>


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
