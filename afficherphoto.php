<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">

<link rel="stylesheet" href="./css/style41.css">
<script src="./js/jquery-3.3.1.js"></script>
<link rel="icon" href="./images/logo.avif" type="image" />
<style>
.container {
  justify-content: center;
  justify-items: center;
  position: relative;
  width: 60%;
  /* max-width: 400px; */
} 

.container img {
  width: 100%;
  height: auto;
}

.container .btn {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translate(-50%, 50%);
  -ms-transform: translate(-50%, 50%);
  background-color: blue;
  color: white;
  font-size: 24px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.container .btn:hover {
  background-color: red;
}
</style>
</head>
<body>

<!-- <h2>Button on Image</h2>
<p>Add a button to an image:</p> -->
<br><br>
<div class="container">
<?php $afficherimage = isset($_GET['image']) ? $_GET['image'] : "";?>
  <img src="pointage/<?= $afficherimage ?>" alt="photo" style="width:100%">
  <button class="btn" onclick="history.back()">Retour</button>
</div>

</body>
</html>
