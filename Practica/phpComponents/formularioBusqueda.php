<form action="" method="post">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <input type="text" class="form-control" placeholder="Search by name" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </div>

    <div class="collapse" id="collapseFilter">
        <div class="card card-body">
            <h4>Filter by category:</h4>
            <div class="form-group">
                <?php
                    $link = db_connect();
                    $qry_generos = "SELECT * FROM generos";
                    $rsc_generos = peticionSQL($qry_generos, $link);
                    if ($rsc_generos) {
                        while ($genero = mysqli_fetch_object($rsc_generos)) {
                            echo "<div class='form-check'>";
                            echo "<input class='form-check-input' type='checkbox' name='genero[]' id='genero{$genero->idGenero}' value='{$genero->idGenero}'";
                            if (isset($_POST["genero"]) && in_array($genero->idGenero, $_POST['genero'])) {
                                echo " checked";
                            }
                            echo ">";
                            echo "<label class='form-check-label' for='genero{$genero->idGenero}'>{$genero->nombreGenero}</label>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
            <div class="form-group">
                <?php
                    $qry_consolas = "SELECT * FROM consolas";
                    $rsc_consolas = peticionSQL($qry_consolas, $link);
                    if ($rsc_consolas) {
                        while ($consola = mysqli_fetch_object($rsc_consolas)) {
                            echo "<div class='form-check'>";
                            echo "<input class='form-check-input' type='checkbox' name='consola[]' id='consola{$consola->idConsola}' value='{$consola->idConsola}'";
                            if (isset($_POST["consola"]) && in_array($consola->idConsola, $_POST['consola'])) {
                                echo " checked";
                            }
                            echo ">";
                            echo "<label class='form-check-label' for='consola{$consola->idConsola}'>{$consola->nombreConsola}</label>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</form>