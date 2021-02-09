<!DOCTYPE html >
<html>
<head>
  <meta charset=utf-8">
   <title>Čūska</title>
  </head>
<body>
<h1>Čūska</h1>


<form method="post" >
  <label for="quantity">Laukuma lielums ( no 5 līdz 30):</label>
  <input type="number" id="size" name="size" min="5" max="30">
  <input type="submit" value = "OK">
</form >
<table border="1" >
 <?php 

 // echo "sssss";
 
 $size =  $_POST['size'];
 // $size = game_size;

for ($i=1; $i<=$size; $i=$i+1)
 {echo ("<tr>");
  for ($j=1 ; $j<=$size*3; $j++)
  {echo ("<td   id='r".$i."c".$j."'><a>o</a></td>");
      }
echo ("</tr>");
}


?>



</table>
<!-- 
// <button type="button" onclick="myFunction()">Set cell color</button>
// <button type="button" onclick="snakeF()">Snake</button>
// <button type="button" onclick="move()">move</button>
-->

<br></br>
<div>
      
<h2>Čūskas garums: <a id="snake_len" name="snake_len"></a></h2>

</div>
<div>
      
<h2>Virziens : <a id="order" name="order"></a></h2>

</div> 
<div>
      
<h2>Skaitājs: <a id="counter" name="counter"></a></h2>

</div>


<script>
let snake_len=0;
const game_size = <?php echo($size); ?>;
// alert ("lielums "+ game_size);
var   arr=["r1c1"];
var direction = "pause";
let grow = 0 ;
appleAdr(); 
snakeF();
function snakeF(){




// alert (arr.length);
for ( let i=0 ; i < arr.length ; i++)
{
  document.getElementById(arr[i]).style.backgroundColor = "black";
// alert (arr[i]);
// return arr;
}

}

function move (){

  // alert  ("garums cuska (arr )= "+ arr.length);
  // alert (  "virziens = "+direction);
  let snake_len = arr.length;
  document.getElementById("snake_len").innerHTML = snake_len;
  let cPos = arr[0].indexOf("c");
  let str = arr[0];
  // alert ("str=  "+ str);
  var arrElLen = str.length;
  // alert ( "garums ="+ arrElLen);
  let rowIndex=arr[0].substr(1,cPos-1);
  let colIndex = arr[0].substr((cPos+1), (arrElLen-1));
  // alert  ( "Rinda = "+ rowIndex + "  Rinda = "+colIndex);
  let   newElr = parseInt(rowIndex) ;
  let   newElc = parseInt(colIndex) ;
  
  switch (direction) {
   case "left":
    newElr = newElr ;
    newElc = newElc -1 ;
    if (newElc == 0  ){
    newElc = game_size*3;
    // alert ("if nostradaja newElc = " );
    }
    break;
   case "right":
    newElr = newElr ;
    newElc = newElc + 1 ; 
    if (newElc == game_size*3+1  ){
    newElc = 1;
    // alert ("if nostradaja newElc = " );
    }    
    break;
    case "up":
     newElr = newElr - 1 ;
     newElc = newElc  ; 
    if (newElr ==  0 ){
    newElr = game_size;
    // alert ("if nostradaja newElc = " );
    }
    break;
    case "down":
    newElr = newElr +1 ;
    newElc = newElc  ; 
    if (newElr == game_size+1  ){
        newElr = 1;
    // alert ("if nostradaja newElc = " );
    }
    break;
    default:
    newElr = newElr ;
    newElc = newElc ;  
  }

  const  newEl = "r"+newElr+"c"+newElc;
 //  alert ("jaunais elements = "+newElc);
  const cellCol = document.getElementById(newEl).style.backgroundColor;
 // alert ("cell color = "+ cellCol);
 
 if (cellCol == "black"){
   alert ("Spēle galā! Rezultāts : "+snake_len);
   window.location = './snake.php/';
 }

 if (cellCol == "green") {
    if ( grow >=0){grow = grow +3;}
    if(grow <0){grow = 4}
  }
    
    // alert ("grow =  "+grow);
  

  arr.unshift(newEl);
  
  // alert ("to remove = "+toRemove);
  // alert ("jaunā čūska " + arr[0]+arr[1]+arr[2]);  
  document.getElementById(arr[0]).style.backgroundColor = "black";
  grow = grow-1;
  //   alert ("grow = "+grow);
  if (grow <= 0 ){
  const toRemove =  arr.pop();
  document.getElementById(toRemove).style.backgroundColor = "white";
   } 
}
// funkcija -  taustina nospiešana

document.addEventListener('keydown', function(event) {
    
  switch (event.keyCode)
  { case 37: 
    direction = "left";
    break;
    case 39: 
    direction = "right";
    break;
    case 38: 
    direction = "up";
    break;
    case 40: 
    direction = "down";
    break;
    case 32: 
    direction = "pause";
    break;
    case 69: 
    direction = "exit";
    break;
    default : "pause";
  }
  
    document.getElementById("order").innerHTML = direction; 
  });

// timera funcija  - izsauc move

var counter=0;

var myVar = setInterval(myTimer, (500-snake_len*4));

function myTimer() {
  
  
  document.getElementById("counter").innerHTML = counter;
  if (direction != "pause"){
    move();
    counter=counter+1;
    if ( counter %10 == 0)
    { appleAdr();  }
    }
}
function appleAdr (){
  const min= 1;
  const max =game_size;
  const aValueMax = 5;
  aRow =  getRndInteger(min,max);
  aCol = getRndInteger(min,max*3);
  aValue = getRndInteger(min,aValueMax);
  aID = 'r'+aRow+'c'+aCol;
 //  alert ( "abola adrese = " + aID );
  // document.getElementById("aID").innerHTML = "5";
  //  document.getElementById(aID).setAttribute('value', 4);
  const aID_col = document.getElementById(aID).style.backgroundColor;
  if (aID_col!="black"){
  document.getElementById(aID).style.backgroundColor = "green";
  }
}


function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}


</script


</body>
</html>
