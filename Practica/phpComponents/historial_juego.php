
        <!--BOTON HISTORIAL-->
        <link rel="stylesheet" type="text/css" href="estilos/popup_reglas.css">
        <!--BOTON INSTRUCCIONES-->
        <div class="boton-modal">
            <label for="btn-modal-instrucciones">
            <span class="icon"> <i class="fa-solid fa-book" style="color:white"></i></span>    
            
            </label>

            <label for="btn-modal-historial">
            <span class="icon"> <i class="fa fa-history" style="color:white;"></i></span>    
            
            </label>

            <label for="btn-modal-ranking">
            <span class="icon"> <i class="fa-solid fa-ranking-star" style="color:white;"></i></span>    
            
            </label>
        </div>
        <!--Fin de Boton-->

        <!--Ventana Modal INSTRUCCIONES-->
        <input type="checkbox" id="btn-modal-instrucciones">
        <div class="container-modal">
            <div class="content-modal">
                <h2>Instrucciones básicas del juego</h2>
                <p>1. Se colocan siete columnas de cartas boca abajo sobre la mesa, con la carta superior de cada columna boca arriba. <br>

                2. Las cartas se mueven en grupos, comenzando por la carta superior de cada columna.<br>

                3. Las cartas se pueden mover a las cuatro pilas de cimentación en orden ascendente, comenzando por el As y terminando con el Rey. Las cartas en las pilas de cimentación deben ser del mismo palo. <br>

                4. Las cartas también se pueden mover de una columna a otra en orden descendente y alternando los colores. Por ejemplo, se puede mover un 8 negro sobre un 9 rojo.<br>

                5. La carta superior de cada columna está disponible para ser movida a otra columna o a una pila de cimentación.<br>

                6. Si una columna está vacía, se puede mover un Rey o un grupo de cartas que comience con un Rey a la columna vacía.<br>

                7. Si se han movido todas las cartas de una columna, se puede colocar un Rey en esa columna.<br>

                8. Si se queda sin movimientos, se puede voltear una carta de la pila de descarte para comenzar una nueva columna.<br>

                9. El juego termina cuando se han movido todas las cartas a las pilas de cimentación en orden ascendente.</p>
                <div class="btn-cerrar">
                    <label for="btn-modal-instrucciones">Cerrar</label>
                </div>
            </div>
            <label for="btn-modal-instrucciones" class="cerrar-modal"></label>
        </div>
        <!--Fin de Ventana Modal INSTRUCCIONES-->

        <!--Ventana Modal HISTORIAL-->
        <input type="checkbox" id="btn-modal-historial">
                <div class="container-modal-historial">
                    <div class="content-modal-historial">
                        <h2>Historial de la partida</h2>
                        <p>Jugador 1: movimiento x       <b>12:05</b>
                        <br>Jugador 2: movimiento y      <b>12:15</b><br>
                        Jugador 1: movimiento x+1        <b>12:25</b>
                        <br>Jugador 2: movimiento y+1    <b>12:34</b><br>
                        Jugador 1: movimiento x+2        <b>12:36</b>
                        <br>Jugador 2: movimiento y+2    <b>12:43</b><br>
                        Jugador 1: movimiento x+3        <b>12:46</b>
                        <br>Jugador 2: movimiento y+3    <b>12:58</b><br>
                        </p>
                        <div class="btn-cerrar">
                            <label for="btn-modal-historial">Cerrar</label>
                        </div>
                    </div>
                    <label for="btn-modal-historial" class="cerrar-modal"></label>
                </div>
                <!--Fin de Ventana Modal HISTORIAL-->

    <!--Fin de Ventana Modal HISTORIAL-->

  

    <!--Ventana Modal RANKING-->
    <input type="checkbox" id="btn-modal-ranking">
        <div class="container-modal-ranking">
            <div class="content-modal-ranking">
                <h2>Ranking</h2>
                <?php
    
    
    include("phpComponents/ranking.php");
   
    
    ?>
                <div class="btn-cerrar">
                    <label for="btn-modal-ranking">Cerrar</label>
                </div>
            </div>
            <label for="btn-modal-ranking" class="cerrar-modal"></label>
        </div>
        <!--Fin de Ventana Modal RANKING-->