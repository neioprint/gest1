<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
<link rel="stylesheet" href="css/normalize.css">

<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">

<link rel="stylesheet" href="./css/style41.css">
<script src="./js/jquery-3.3.1.js"></script> -->
<link rel="icon" href="./images/logo.avif" type="image" />
<style>
.container {
  /* position: relative;
  width: 100%; */
  /* max-width: 400px; */

  display: inline-block;
    margin: 30px;
} 

.container img {
  display: block;
    margin: 0 auto;


  /* width: 100%;
  height: auto; */
}

.container .btn {
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: blue;
  color: white;
  font-size: 20px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.container .btn:hover {
  background-color: red;
}
.box {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    /* width: 250px;
    height: 200px; */
    border: 3px solid blue;
    border-radius: 5px;
}
</style>
</head>
<body>

<!-- <h2>Button on Image</h2>
<p>Add a button to an image:</p> -->
<br><br>
<div class="container">
<div class="box">
<?php $afficherimage = isset($_GET['image']) ? $_GET['image'] : "";?>
  <img src="uploads/<?= $afficherimage ?>" alt="Snow" style="width:100%">

  <button class="btn" onclick="history.back()">Retour</button>
</div>
</div>

</body>
</html>
