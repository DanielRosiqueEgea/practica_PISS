let slideIndex = [0,0,0,0]; //index para todos los slideShows que pueden haber, por ahora solo hay uno
let slideId = ["mySlides1","mySlides2","mySlides3","mySlides4"]; //id de los elementos slide

$(document).ready(function iniciarSlides(){

mostrar(0, 0);
mostrar(0, 1);
mostrar(0,2);
});

function plusSlides(n, no) {
    mostrar(slideIndex[no] += n, no);
}


function mostrar(n, no) { //n es el index de donde empieza a mostrar imagenes 
  let i;
 
let slides =  document.getElementsByClassName(slideId[no]); //cogemos los elementos de la clase MySlides1

//solo queremos que se muestren 4 imagenes cada vez, de ahí el -3
//por ello solo nos podemos ejecutar lo siguiente si hay más de 4
// si hay 4 siempre se muestran todas y ya
if(n<0){
    slideIndex[no]=n=slides.length-4;
}
if(slides.length>4){  
slideIndex[no]= n= n%(slides.length-3);

console.log(n);
//ocultamos todas las slides 
for(i=0;i<slides.length;i++){
    $(slides[i]).hide();
    //le quitamos la clase first a first child a todas
    slides[n].classList.remove("first-child");
}

  for(i=n;i<n+4;i++){
        $(slides[i]).show();
    }
    //le ponemos la clase first-child a n (el nuevo primer hijo)
    slides[n].classList.add("first-child");
}


}


function irAJuego(enlace){
    
    
    window.location.href = "juego.php?juego="+enlace;

}
