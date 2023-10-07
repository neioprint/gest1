<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="js/jsPDF/dist/jspdf.min.js"></script>
</head>
<body>
<div id="content">
    <!-- HTML contnet goes here -->
    <h1>hjkhkhjkhjkhjkhjkhjkhjk</h1>
</div>

<div id="elementH"></div>
  <script>
 var doc = new jsPDF({
    orientation: 'landscape'
});

doc.text(20, 20, 'Hello world!');
doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');

// Add new page
doc.addPage();
doc.text(20, 20, 'Visit CodexWorld.com');

// Save the PDF
doc.save('document.pdf');
  </script>
</body>
</html>