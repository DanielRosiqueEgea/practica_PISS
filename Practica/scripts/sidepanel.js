/* Set the width of the sidebar to 250px (show it) */
var open =0;
function openNav(button) {
  if(open==0){
    $("#mySidepanel").css("height", "100px");
    button.getElementsByTagName("i")[0].classList.add('fa-times');

    button.getElementsByTagName("i")[0].classList.remove('fa-bars');
    open=1;
  } else{
    $("#mySidepanel").css("height" , "0");
    open=0;
    button.getElementsByTagName("i")[0].classList.remove('fa-times');

    button.getElementsByTagName("i")[0].classList.add('fa-bars');
  }
    
  }
  
  /* Set the width of the sidebar to 0 (hide it) */
  function closeNav() {
    $("#mySidepanel").css("height" , "0");
    
  }


function openCloseDrop(dropdown){
 //var dropdown = document.getElementsByClassName("dropdown-btn");
  dropdown.classList.toggle("active");
  var caret = dropdown.getElementsByClassName("fa");
  caret[0].classList.toggle("caret_down");
  var dropdownContent = dropdown.nextElementSibling;
  $(dropdownContent).toggle(30);

}