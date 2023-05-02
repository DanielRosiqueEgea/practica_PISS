<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fractal Games Juego</title>
    <link rel="stylesheet" type="text/css" href="estilos/body.css">
    <meta charset="UTF-8">
    <title>Foro de Videojuegos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php 
    include("head.php");
    include("phpComponents/topbar.php");
    include("phpComponents/sidepanel.php");
    ?>
    <div class="container">
        <h1 class="text-center mt-5" style="font-weight: bold; text-shadow: 2px 2px #e6e6e6; color: white;">Foro de Videojuegos</h1>
        <form action="#" method="post" enctype="multipart/form-data" class="mt-5">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="game_file" class="form-label">Archivo de juego</label>
                <input type="file" class="form-control" id="game_file" name="game_file" accept=".zip" required>
                <div class="form-text">Sube un archivo zip con el contenido del juego</div>
            </div>
            <button type="submit" class="btn btn-primary">Subir</button>
        </form>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('form').submit(function(){
                // Show alert when submitting the form
                alert("Subiendo juego...");
            });
        });
    </script>
    <?php include("phpComponents/footer.php");?>
</body>
</html>
