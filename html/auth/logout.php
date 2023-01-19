<?php
require("../var/var.php");


function redirectWithClear($callBackUrl)
{
    session_start();
    session_destroy();

    setcookie("token", "", -1, "/", DOMAIN, true, true);
    setcookie("user_id", "", -1, "/", DOMAIN, true, true);
    setcookie("user_phone", "", -1, "/", DOMAIN, true, true);

    header("location: " . $callBackUrl);
}


$callBackUrl = "../home/";
redirectWithClear($callBackUrl);


?>





<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crush Pay | User Auth</title>



    <!-- MyStyle--------------------------START -->
    <link rel="stylesheet" href="../css/vendor/main.css">
    <!-- MyStyle--------------------------END -->
</head>

<body>

    <div id="preloader">

    </div>




    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- MY Scripts-------------------------START -->
    <script src="../scripts/main.js"></script>
    <!-- MY Scripts-------------------------END -->
</body>

</html>