<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href="assets/leaflet/leaflet.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/maps.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/leaflet/leaflet.js"></script>
    <script src="assets/js/jakarta.js"></script>
    <script src="assets/js/inside.js"></script>
    <script src="assets/js/cctv.js"></script>
</head>

<body>
    <?php

        require "engine_php/App.php";
        $app = new App();

        include "view/default/navbar.php";
    ?>
        <?php
        include "view/map/map.php";
    ?>
</body>

</html>