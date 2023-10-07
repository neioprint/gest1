<?php
$header = "MIME-Version: 1.0\r\n";
$header.= "From:contact@global2pub.com\n";
$header.= 'Content-Type:text/html; charset="utf-8"'."\n";
// $header.= 'Content-Transfert-Encoding: 8bit';
$to='neioprint@gmail.com';
$message="
<html>
    <body>
    <img src='https://neio.global2pub.com/images/logoneio.png' width='50px' height='auto'>
        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at bibendum sem, eu congue metus. Etiam sodales nisi orci, eu lobortis lectus imperdiet vitae. Nunc sodales metus tellus, quis lacinia velit aliquet sit amet. Quisque viverra facilisis pulvinar. Aliquam placerat pulvinar luctus. Cras tortor sapien, porttitor in nibh sit amet, pretium convallis risus.
        </div>
        <div>
        <img src='https://neio.global2pub.com/images/banner1.jpg' width='50%' height='auto'>
       
        </div>
        <p> Nulla tristique posuere urna in vehicula. Sed ullamcorper cursus odio, in venenatis elit pharetra id. Maecenas placerat dui eget condimentum dapibus. Praesent vel consequat turpis. Nunc turpis eros, tempor in enim sed, posuere dapibus tortor. Donec eu orci nisi. Ut sed libero a diam pretium volutpat in non ex. Duis sit amet volutpat mi. Sed sollicitudin nec nibh maximus eleifend. Vestibulum non rhoncus augue</p>
      
    </body>
</html>
";
mail($to, "Image a voir", $message, $header);