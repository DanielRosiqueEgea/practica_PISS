   <script src="scripts/jquery-3.6.0.min.js"></script>
  <canvas id="my_canvas" width="115" height="100"></canvas>
  <style>
  #my_canvas{
    position:fixed; 
    top:0;
    left:0;
    z-index: -1;
  }
  </style>
  <script>
   
$( document ).ready( function() {

var $canvas = $( 'canvas#my_canvas' );
$canvas[0].width = document.body.clientWidth;
$canvas[0].height = document.body.clientHeight; 
var ctx = $canvas[0].getContext('2d');

var canvas_width = $canvas[0].width;
var canvas_height = $canvas[0].height;

var n = 7;
var cell_size = 70;
var hsh = 5;
var vsh = 3;
var color = 'green';
var line_width = 4;

var draw = function() {
cell_size = 50;
line_width = 4;
draw_dragon(ctx);
};

function draw_dragon(ctx) {
/*
var n   = document.getElementById('ord').value;
var cell_size  = document.getElementById('sci').value;
var hsh = document.getElementById('hshi').value;
var vsh = document.getElementById('vshi').value;
var clr = document.getElementById('cli').value;
*/
n =  7;
//console.log( 'n=' + n + ', cell_size='+cell_size + ', vsh=' + vsh + ', hsh=' + hsh );
var c = c1=c2=c2x=c2y=x=y=0;
var d = 1;
var n = Math.pow(2,n); 

x=hsh; 
y=vsh; 
// Cleaning canvas, init plotting
ctx.fillStyle="rgba(255, 255, 255, 0.5)";
//ctx.translate(0.5,0.5); // Fix for the half-pixel issue
ctx.fillRect(0,0,canvas_width,canvas_height);

var old_x = x, old_y = y;
for( i = 0; i <= n; ) {
  ctx.beginPath();
  ctx.moveTo( hsh + old_x*cell_size
, vsh + old_y*cell_size
 );
  ctx.lineTo( hsh + x*cell_size
,     vsh + y*cell_size
 );
  ctx.strokeStyle = colors[ mrand_i(colors.length+2) ];
  ctx.lineWidth = line_width;
  ctx.lineCap = 'round';
  ctx.stroke();
  c1=c&1; c2=c&2;
  c2x=1*d;
  if(c2>0) 
c2x=(-1)*d
  
  c2y=(-1)*c2x;

  old_x = x;
  old_y = y;
  
  if(c1>0) y+=c2y
  else     x+=c2x
  
  i++;
  c+=i/(i&-i);
}
}

var colors = [ '#00ff00', '#00a800', '#006800'];

var paint = function(ctx) {
    c_curve(x, y, len, alpha_angle, iteration_n, ctx);
};

var mrand_i = function(max) {
return Math.floor( Math.random()*max );
};

draw();



} );

    </script>
