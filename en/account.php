<?php
    require_once('HTTPS.php');

    session_start();
    if($_SESSION['name'] == ""){
        session_destroy();
        header("Location: landing.php");
    }
    $_SESSION['offset'] = 0;
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

    <form id="sugar" name="sugar">
        <label for="value"><b>Bloodglucose level</b></label>
        <input type="text" placeholder="Enter bloodglucose level" name="value" required>

        <label for="date"><b>date</b></label>
        <input type="date" name="date" value="<? echo date("Y-m-d")?>" required>

        <label for="time"><b>time</b></label>
        <input type="time" name="time" value="<? echo date("H:i")?>" required>
        <input type="hidden" name="offset" value="0" id="offset">
        <button type="submit">submit</button>
    </form>
    <button onclick="increaseoffset()">-></button><button onclick="decreaseoffset()">-></button>
    <script>

        function increaseoffset(){

            document.getElementById("offset").value = 1;

            const formData = new FormData(sugar);

            fetch('fsugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    $('#chartContainer').html(text);
                }).catch(function (error) {
                    console.error(error);
                })
        }
        function decreaseoffset(){

            document.getElementById("offset").value = 2;

            const formData = new FormData(sugar);

            fetch('fsugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    eval(text);
                }).catch(function (error) {
                    console.error(error);
                })
        }
        function fetchnewest(){

            document.getElementById("offset").value = 0;

            const formData = new FormData(sugar);

            fetch('fsugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    eval(text);
                }).catch(function (error) {
                    console.error(error);
                })
        }

        const sugar = document.getElementById('sugar');

        sugar.addEventListener('submit', function (e) {

            e.preventDefault();

            document.getElementById("offset").value = 0;

            const formData = new FormData(this);

            fetch('sugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    document.getElementById("result").innerHTML = (text);
                }).catch(function (error) {
                    console.error(error);
                })

            fetchnewest();
        });
        fetchnewest();
    </script>
    <p id = "result"></p>
    <div id="chartContainer"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <div id="wat"></div>
</body>
</html>