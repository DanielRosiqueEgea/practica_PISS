<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilos/formLogin.css">
</head>
<body>


<div id="id02" class="modal">
  
  <form class="modal-content animate" action="/Practica/registro.php" method="post">
    <div class="containerRegistro">
      <label for="nickname"><b>Nickname</b></label>
      <input type="text" placeholder="Introduce usuario" name="nickname" required>
      <label for="nombre"><b>Nombre</b></label>
      <input type="text" placeholder="Introduce nombre" name="nombre" required>
      <label for="Apellidos"><b>Apellidos</b></label>
      <input type="text" placeholder="Introduce Apellidos" name="apellidos" required>
      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Introduce email" name="email" required>
      <label for="fechaNac"><b>Fecha Nacimiento</b></label>
      <input type="date" name="fechaNac" required>
      <label for="psw"><b>Contraseña</b></label>
      <input type="password" placeholder="Introduce Contraseña" name="pass" required>
        
      <button type="submit">Registro</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancelar</button>
      <span class="psw"><a href="javascript:void(document.getElementById('id02').style.display='none',
      document.getElementById('id01').style.display='block');">Inicio Sesion</a></span>
    </div>
  </form>
</div>


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/Practica/login.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="imagenes/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="containerLogin">
      <label for="uname"><b>Nickname</b></label>
      <input type="text" placeholder="Introduce Nickname" name="nombre" required>

      <label for="psw"><b>Contraseña</b></label>
      <input type="password" placeholder="Introduce Contraseña" name="pass" required>
        
      <button type="submit">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
      <span class="psw"><a href="javascript:void(document.getElementById('id01').style.display='none',document.getElementById('id02').style.display='block')">Registrtro</a></span>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 =document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
</script>