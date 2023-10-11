<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-2.1.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js" integrity="sha512-CwHUCK55pONjDxvPZQeuwKpxos8mPyEv9gGuWC8Vr0357J2uXg1PycGDPND9EgdokSFTG6kgSApoDj9OM22ksw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="face-api.min.js"></script>
    <style>
        #overlay, .overlay {
            position: absolute;
            top: 0;
            left: 0;
            }
        </style>

<!-- Application JS -->
<script src="faceSystem.js"></script>
</head>
<body>
    <img src="../labeled_images/aicha.png" id="originalImg"/>
    <canvas id="reflay" class="overlay"></canvas>
</body>
</html>