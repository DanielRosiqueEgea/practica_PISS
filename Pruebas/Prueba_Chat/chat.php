<link href="chat.css" rel="stylesheet">

<div class="floating-chat">
    <i class="fa fa-comments" aria-hidden="true"></i>
    <div class="chat">
        <div class="header">
             <span><button class="cambiarUsaurio" value="3">Usuario 3 </button> </span> 
             <span><button class="cambiarUsaurio" value="4">Usuario 4 </button> </span> 
            <button>
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

$user_id = null;
if(isset($_SESSION['user'])){
$user_id = $_SESSION['user'];
}
$otherUser = $user_id==1?3:1;

// Crear una variable JavaScript con el ID de usuario
echo "<script>var userId = " . $user_id . ";
var otherUser = ".$otherUser."
</script>";

?>
<script src="chat.js"></script>
