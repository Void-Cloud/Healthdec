<?php
    require_once('HTTPS.php');

    session_start();
    if($_SESSION['name'] == ""){
        session_destroy();
        header("Location: landing.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>account page :DDD</title>
    <link rel="stylesheet" href="accountstyle.css">
</head>
<body>
    <p>hei, <? echo $_SESSION['name'] ?> :) <br> kirjauduit sisään onnistuneesti! YATTA!<br><br>
    paina <a href="logout.php">tästä</a> kirjautuaksesi ulos niin ei jää sessio kummittelemaan selaimeesi</p>
</body>
</html>