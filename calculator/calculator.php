<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
  <title>Calculator | Pure CSS |</title>
  <link rel="stylesheet" href="./style.css">
  
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
      <form action="" name="calc" class="calculator">
        <input type="text" class="value" readonly name="txt" />
        <span class="num clear" onclick="calc.txt.value=''"><i>C</i></span>
        <span class="num" onclick="calc.txt.value+='/'"><i>/</i></span>
        <span class="num" onclick="calc.txt.value+='*'"><i>*</i></span>
        <span class="num" onclick="calc.txt.value+='7'"><i>7</i></span>
        <span class="num" onclick="calc.txt.value+='8'"><i>8</i></span>
        <span class="num" onclick="calc.txt.value+='9'"><i>9</i></span>
        <span class="num" onclick="calc.txt.value+='-'"><i>-</i></span>
        <span class="num" onclick="calc.txt.value+='4'"><i>4</i></span>
        <span class="num" onclick="calc.txt.value+='5'"><i>5</i></span>
        <span class="num" onclick="calc.txt.value+='6'"><i>6</i></span>
        <span class="num plus" onclick="calc.txt.value+='+'"><i>+</i></span>
        <span class="num" onclick="calc.txt.value+='1'"><i>1</i></span>
        <span class="num" onclick="calc.txt.value+='2'"><i>2</i></span>
        <span class="num" onclick="calc.txt.value+='3'"><i>3</i></span>
        <span class="num" onclick="calc.txt.value+='0'"><i>0</i></span>
        <span class="num" onclick="calc.txt.value+='00'"><i>00</i></span>
        <span class="num" onclick="calc.txt.value+='.'"><i>.</i></span>

        <span
          class="num equal"
          onclick="document.calc.txt.value=eval(calc.txt.value)"
          ><i>=</i></span
        >
      </form>
    </div>
<!-- partial -->
  <!-- <script  src="./script.js"></script> -->

</body>
</html>
