<!-- Footer -->
<footer class="bg-dark text-center text-white">

<style>
		.animada {
			transition: transform 0.3s ease-out;
		}

		.animada:hover {
			transform: scale(1.1);
		}
    .animada-hover {
  color: #ff6ec7; /* Cambiar por el color rosa neon deseado */
}
</style>

<script>
		function animar(element) {
			element.setAttribute('src',"imagenes/transparent_logo.gif");
      
		}

		function detener(element) {
			element.setAttribute('src',"imagenes/bandidosBinarios-removebg-preview.png");
		}
    
</script>
<!-- Grid container -->
  <div class="container p-4">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-github"></i
      ></a>
    </section>
    <!-- Section: Social media -->

    <!-- Section: Form -->
    <section class="">
      <form action="">
        <!--Grid row-->
        <div class="row d-flex justify-content-center">
          <!--Grid column-->
          <div class="col-auto">
            <p class="pt-2">
              <strong>Suscríbete a nuestro boletín</strong>
            </p>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-5 col-12">
            <!-- Email input -->
            <div class="form-outline form-white mb-4">
              <input type="email" id="form5Example21" class="form-control" />
              <label class="form-label" for="form5Example21">Dirección email</label>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-auto">
            <!-- Submit button -->
            <button type="submit" class="btn btn-outline-light mb-4">
              Suscríbete
            </button>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </form>
    </section>
    <!-- Section: Form -->

    <!-- Section: Text -->
    <section class="mb-4">
      <p>
      ¡Únete a la comunidad de millones de jugadores de todo el mundo que aman nuestra plataforma de juegos en línea! Ofrecemos la tecnología de juego más avanzada para que puedas sumergirte en emocionantes juegos, conectarte con otros jugadores y competir en torneos en línea. Además, te mantendremos al día con las últimas noticias de juegos, lanzamientos y promociones a través de nuestro boletín y nuestras redes sociales. Nos encantaría que te unas a la comunidad y compartas tus aventuras de juego con el resto del mundo.
      </p>
    </section>
    <!-- Section: Text -->
        <!--Grid column-->
          <div class="d-flex justify-content-center align-items-center">
          <img class="animada" onmouseover="animar(this)" onmouseout="detener(this)" src="imagenes/bandidosBinarios-removebg-preview.png" weight=70 height="70">
          </div>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </section>
    <!-- Section: Links -->
  </div>
  <!-- Grid container -->
  
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgb(60, 60, 60)">
    © 2020 Copyright:
    <a class="text-white" href="https://mdbootstrap.com/">Fractal Games</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
