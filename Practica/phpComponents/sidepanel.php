<script src="scripts/sidepanel.js"></script>
<link href="estilos/sidepanel.css" rel="stylesheet">
<nav id="mySidepanel" class="sidepanel d-flex justify-content-center">

        <a class="dropdown-btn" href="javascript:void(0)" onclick="openCloseDrop(this)">Categorías <i class="fa fa-caret-right"></i></a>

        <span class="segundolvl">
            <?php include_once("funcionBBDD.php");
            $link = db_connect();
            $qry_generos = "SELECT * FROM generos";
            $rsc_generos = peticionSQL($qry_generos,$link);
            if($rsc_generos){
                
            while ($genero = mysqli_fetch_object($rsc_generos)) {
                
            ?>
            <form method="post" action="catalogo.php" class="inline">
                <input type="hidden" name="extra_submit_param" value="extra_submit_value">
                <button type="submit" name="genero[]" class="enlaceCatalogo" value="<?=$genero->idGenero?>" class="link-button">
                <?=$genero->nombreGenero?>
                </button>
                </form> 
            <!-- <a href="catalogo.php?genero=<=$genero->idGenero?>"><=$genero->nombreGenero?></a> -->
            <?php }}?>

        </span>

        <a class="dropdown-btn" href="javascript:void(0)" onclick="openCloseDrop(this)">Nº Jugadores <i
                class="fa fa-caret-right"></i></a></li>
        <span class="segundolvl">
        <?php 
            $qry_consolas = "SELECT * FROM consolas";
            $rsc_consolas = peticionSQL($qry_consolas,$link);
            if($rsc_consolas){
                
            while ($consola = mysqli_fetch_object($rsc_consolas)) {
                
            ?>
              <form method="post" action="catalogo.php" class="inline">
                <input type="hidden" name="extra_submit_param" value="extra_submit_value">
                <button type="submit" name="consola[]" class="enlaceCatalogo" value="<?=$consola->idConsola?>" class="link-button">
                <?=$consola->nombreConsola?>
                </button>
                </form> 
            <!-- <a href="catalogo.php?consola=<=$consola->idConsola?>"><=$consola->nombreConsola?></a> -->
            <?php }}?>
            
        </span>
        <a href="catalogo.php?all=1">Catalogo</a>

<a href="foro.php">Acceso al foro</a>      

        <nav class="busqueda">
            <form action="catalogo.php" method="post">
                <input type="text" placeholder="Busqueda.." name="nombre" required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </nav>
        
    </nav>