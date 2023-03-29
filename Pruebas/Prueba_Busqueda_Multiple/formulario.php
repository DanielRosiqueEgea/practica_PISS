<form action="catalogo.php" method="post">
<ul>
    <?php include_once("../../Practica/phpComponents/funcionBBDD.php");
   
            $link = db_connect();
            $qry_generos = "SELECT * FROM generos";
            $rsc_generos = peticionSQL($qry_generos,$link);
            if($rsc_generos){
                
            while ($genero = mysqli_fetch_object($rsc_generos)) {
            
                ?>
                <li><?=$genero->nombreGenero?><input type="checkbox" name="genero[]" id="genero" value="<?=$genero->idGenero?>"></li>
<?php
            }
        }
    ?>
    <li><input type="submit" value="submit">
</ul>
</form>