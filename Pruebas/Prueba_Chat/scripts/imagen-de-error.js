window.onload =function() {
    console.log("imagen-de-error.js");
    var images = document.getElementsByTagName('img');
    for (var i = 0; i < images.length; i++) {
    //   images[i].onerror="this.src='imagenes/img_not_found.webp';";
    
        images[i].addEventListener('error', function() {
       this.src='imagenes/img_not_found.webp';
       console.log('Ha ocurrido un error al cargar la imagen');
      });
      images[i].src=images[i].src;
    }
  };