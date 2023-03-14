<script src="scripts/sidepanel.js"></script>
<link href="estilos/sidepanel.css" rel="stylesheet">
<nav id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
        <nav class="busqueda">
            <form action="catalogo.php" method="GET">
                <input type="text" placeholder="Busqueda.." name="nombre" required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </nav>

        <a class="dropdown-btn" href="javascript:void(0)" onclick="openCloseDrop(this)">Categorías <i
                class="fa fa-caret-right"></i></a>

        <span class="segundolvl">
            <?php include_once("funcionBBDD.php");
            $link = db_connect();
            $qry_generos = "SELECT * FROM generos";
            $rsc_generos = peticionSQL($qry_generos,$link);
            if($rsc_generos){
                
            while ($genero = mysqli_fetch_object($rsc_generos)) {
                
            ?>
            <a href="catalogo.php?genero=<?=$genero->idGenero?>"><?=$genero->nombreGenero?></a>
            <?php }}?>

        </span>

        <a class="dropdown-btn" href="javascript:void(0)" onclick="openCloseDrop(this)">Consolas <i
                class="fa fa-caret-right"></i></a></li>
        <span class="segundolvl">
        <?php 
            $qry_consolas = "SELECT * FROM consolas";
            $rsc_consolas = peticionSQL($qry_consolas,$link);
            if($rsc_consolas){
                
            while ($consola = mysqli_fetch_object($rsc_consolas)) {
                
            ?>
            <a href="catalogo.php?consola=<?=$consola->idConsola?>"><?=$consola->nombreConsola?></a>
            <?php }}?>
            
        </span>
        <a href="catalogo.php?all=1">Catalogo</a>
        
    </nav>