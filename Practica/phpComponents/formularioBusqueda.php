<form action="" method="post">
<!-- <form action="formularioBusqueda.php" method="post"> for Testing -->

    <?php include_once("funcionBBDD.php");
   
            $link = db_connect();
            $qry_generos = "SELECT * FROM generos";
            $rsc_generos = peticionSQL($qry_generos,$link);
            if($rsc_generos){
                echo "<ul>";
            while ($genero = mysqli_fetch_object($rsc_generos)) {
            
                ?>
                
                <li><?=$genero->nombreGenero?><input type="checkbox" name="genero[]" id="genero" value="<?=$genero->idGenero?>" 
                
                <?php
                if (isset($_POST["genero"]) && in_array($genero->idGenero, $_POST['genero'])) {
                    echo("checked");
                  } 
                ?>></li>
<?php
            }
            echo "</ul>";
        }
        $qry_consolas = "SELECT * FROM consolas";
        $rsc_consolas = peticionSQL($qry_consolas,$link);
        if($rsc_consolas){
            echo "<ul>";
        while ($consola = mysqli_fetch_object($rsc_consolas)) {
            ?>
            <li><?=$consola->nombreConsola?><input type="checkbox" name="consola[]" id="consola" value="<?=$consola->idConsola?>" 
            <?php
             if (isset($_POST["consola"]) && in_array($consola->idConsola, $_POST['consola'])) {
                    echo("checked");
                  } 
            ?>></li>
    <?php
    
                }
                echo "</ul>";
            }
    ?>

            <ul> <li>Nombre Juego <input type="text" placeholder="Busqueda.." name="nombre"
            
            <?php
             if (isset($_POST["nombre"])) {
                    echo " value = \"".$_POST["nombre"]."\"";
                  } 
            ?>
            
            > </li> </ul>

    <input type="submit" value="submit">

</form>