<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

</body>

</html>






<script>
  import {
    jsPDF
  } from "jspdf";
  var doc = new jsPDF();

  function saveDiv(divId, title) {
    doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
    doc.save('div.pdf');
  }

  function printDiv(divId,
    title) {

    let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

    mywindow.document.write(`<html><head><title>${title}</title>`);
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(divId).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
  }
</script>
<p>don't print this to pdf</p>
<div id="pdf">
  <p>
    <font size="3" color="red">print this to pdf</font>
  </p>
</div>

<button onclick="printDiv('pdf','Title')">print div</button>

<button onclick="saveDiv('pdf','Title')">save div as pdf</button>