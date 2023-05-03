<form action="" method="post">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button id="toggle-button" class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter" style="background-color: #FF8E3C; border-color: #f2f2f2;" onclick="toggleSearchForm()">+</button> 
                <span class="sidepanel-toggler-icon"></span>
            </button>
        </div>
        <input type="text" class="form-control" placeholder="Buscar por nombre" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" style="background-color: #FF8E3C; border-color: #f2f2f2;">Búsqueda</button>
        </div>
    </div>

    <div class="collapse" id="collapseFilter">
        <div class="card card-body">
            <h4>Filtrar por categoría...</h4>
            <div class="form-group">
                <div class="d-flex flex-wrap">
                    <?php
                        $link = db_connect();
                        $qry_generos = "SELECT * FROM generos";
                        $rsc_generos = peticionSQL($qry_generos, $link);
                        if ($rsc_generos) {
                            while ($genero = mysqli_fetch_object($rsc_generos)) {
                                echo "<div class='form-check mr-3'>";
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
            </div>
            <div class="form-group">
                <div class="d-flex flex-wrap">
                    <?php
                        $qry_consolas = "SELECT * FROM consolas";
                        $rsc_consolas = peticionSQL($qry_consolas, $link);
                        if ($rsc_consolas) {
                            while ($consola = mysqli_fetch_object($rsc_consolas)) {
                                echo "<div class='form-check mr-3'>";
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
    </div>
</form>
<script>
function toggleSearchForm() {
  var searchForm = document.getElementById("collapseFilter");
  var toggleButton = document.getElementById("toggle-button");
  
  if (searchForm.classList.contains("collapse")) {
    // Open the search form
    searchForm.classList.remove("collapse");
    toggleButton.innerHTML = "-";
  } else {
    // Close the search form
    searchForm.classList.add("collapse");
    toggleButton.innerHTML = "+";
  }
}
</script>