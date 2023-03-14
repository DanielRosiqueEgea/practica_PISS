/* Set the width of the sidebar to 250px (show it) */
function openNav() {
    $("#mySidepanel").css("width", "250px");
  }
  
  /* Set the width of the sidebar to 0 (hide it) */
  function closeNav() {
    $("#mySidepanel").css("width" , "0");
  }


function openCloseDrop(dropdown){
 //var dropdown = document.getElementsByClassName("dropdown-btn");
  dropdown.classList.toggle("active");
  var caret = dropdown.getElementsByClassName("fa");
  caret[0].classList.toggle("caret_down");
  var dropdownContent = dropdown.nextElementSibling;
  $(dropdownContent).toggle(30);

}