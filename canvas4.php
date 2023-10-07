
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Shema de coupe</h1>
<div>


<canvas id="myCanvas"   style="border:3px dashed blue;">

</canvas> 

</div>
<!-- $nbpose1=$coupeintx*$coupeinty;
        $nbpose2=$coupeintxtrans*$coupeintytrans; -->
<!-- // javascript du canvas -->
<script>
const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");
canvas.width=1020;
canvas.height=690;
let origine=20;
ctx.strokeStyle = "red";
ctx.translate(origine, origine);
//origine=0;
//  ctx.scale(0.9, 0.9);
ctx.font = "30px Arial";
ctx.direction = "ltr";
ctx.lineWidth = "3";
// ctx.lineJoin="round";
// ctx.lineCap="round";

ctx.beginPath();
// ctx.translate(800, 0);

// ctx.rotate(90*Math.PI/180);
ctx.rect(0,0,280,210);//pose 1
ctx.moveTo(170, 110);
ctx.arc(140, 110, 30, 0, 2 * Math.PI);
 ctx.fillText("1",130, 120);// texte


ctx.rect(0,210,280,210);//pose 2
ctx.moveTo(170, 320);
ctx.arc(140, 320, 30, 0, 2 * Math.PI);
 ctx.fillText("2",130, 320);// texte


ctx.rect(0,420,280,210); // pose 3
ctx.rect(0,630,280,20); //chute

ctx.rect(280,0,210,280); //pose 4
ctx.rect(280,280,210,280);//pose 5
ctx.rect(280,560,210,90);//chute


ctx.rect(490,0,280,210);// pose 6
ctx.rect(490,210,280,210);// pose 7
ctx.rect(490,420,280,210);// pose 8
ctx.rect(490,630,280,20); //chute


ctx.rect(770,0,210,280); //pose 9
ctx.rect(770,280,210,280);//pose 10
ctx.rect(770,560,210,90);//chute




ctx.stroke();  


</script>

</body>
</html>