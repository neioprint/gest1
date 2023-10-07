
<?php
    $img = file_get_contents("php://input"); // $_POST didn't work
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/img")) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . "/img", 0777, true);
    }
    
    $file = $_SERVER['DOCUMENT_ROOT'] . "/img/".time().'.png';
    
    $success = file_put_contents($file, $data);
    print $success ? $file.' saved.' : 'Unable to save the file.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<script>
var off_canvas = document.createElement('canvas');
off_canvas.width = 1080;
off_canvas.height = 1080;
var off_ctx = off_canvas.getContext("2d");

off_ctx.beginPath();
off_ctx.rect(20, 20, 150, 800);
off_ctx.fillStyle = "red";
off_ctx.fill();

var brick = new Image();
brick.src =  "./images/annonce2.png";
brick.onload = function(){
    var pattern = off_ctx.createPattern(brick, "repeat");
    off_ctx.fillStyle = pattern;
    off_ctx.fillRect(500, 0, 1000, 1000);
    
    // needs delay to fully render to canvas
    var timer = window.setTimeout(save_canvas(off_canvas), 500);
};

function save_canvas(c) {
    var b64Image = c.toDataURL("image/png");
    console.log(b64Image);
    fetch("../php/save_image_b64.php", {
        method: "POST",
        mode: "no-cors",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: b64Image
    })  .then(response => response.text())
        .then(success => console.log(success))
        .catch(error => console.log(error));
}
</script>
</body>
</html>