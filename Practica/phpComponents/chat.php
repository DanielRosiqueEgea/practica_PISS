<?php
 if (!headers_sent() && '' == session_id()) {
    session_start();
}
if(!isset($_SESSION['user'])){
    exit;
}
?>
<link href="estilos/chat.css" rel="stylesheet">

<div class="floating-chat">
    
    <i class="fa fa-comments" aria-hidden="true"></i>
    <div class="chat">
          <div class="chatusers">
        <?php
        // Obtener los IDs y nombres de usuario de la base de datos
        include_once("funcionBBDD.php");
        $link = db_Connect();
        $result = mysqli_query($link, "SELECT * FROM usuarios");

        // Generar un botón para cada usuario
        while ($row = mysqli_fetch_object($result)) {
            if($row->idUsuario==$_SESSION['user']){
                continue;
            }
            $userId = $row->idUsuario;
            $userName = $row->nickname;
            
            echo "<button class=\"user-button\" data-id=\"".$userId."\" ><i class=\"fa fa-user\" aria-hidden=\"true\"></i>".$userName." </button> ";
        }
        // GENERAR BOTONES DE MENTIRA
        for($i=0;$i<20;$i++){
            echo "<button class=\"user-button\" data-id=\"\" ><i class=\"fa fa-user\" aria-hidden=\"true\"></i>".$userName." </button> ";
        }
    ?>
         
        </div>
        
        <div class="header">
            
         <button class="close-button">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
                         
        </div>
      
        <ul class="messages">
           
        </ul>
        <div class="footer">
            <div class="text-box" contenteditable="true" disabled="true"></div>
            <button id="sendMessage">send</button>
        </div>
    </div>
</div>
<?php 

$user_id = 0;

if(isset($_SESSION['user'])){
$user_id = $_SESSION['user'];
}
$otherUser = 0;

// Crear una variable JavaScript con el ID de usuario
echo "<script>var userId = " . $user_id . ";
var otherUser = ".$otherUser.";
</script>";

?>
<script> 
const cambiarUsuarioBtns = document.querySelectorAll(".user-button");

// itera a través de cada botón y agrega un evento onclick
for (let i = 0; i < cambiarUsuarioBtns.length; i++) {
  const btn = cambiarUsuarioBtns[i];
  // obtiene el valor de la propiedad "value" del botón
  const usuario = btn.dataset.id;
  
  btn.onclick = function() {
    // función a ejecutar al hacer clic en el botón
    console.log("Se ha seleccionado el usuario: " + usuario);
   

    var activeButton = document.querySelector(".user-button.active");
      if (activeButton) {
        activeButton.classList.remove("active");
      }
      // Agregar la clase "active" al botón que se acaba de hacer clic
      this.classList.add("active");
    otherUser= usuario;
    // aquí puedes añadir la lógica necesaria para cambiar de usuario
  }
}
</script>
<script src="scripts/chat.js"></script>
