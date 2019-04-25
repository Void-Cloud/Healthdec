<?php
    require_once('HTTPS.php');

    session_start([
        'read_and_close'  => true,
    ]);
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

    <form id="sugar">
        <label for="value"><b>Bloodglucose level</b></label>
        <input type="text" placeholder="Enter bloodglucose level" name="value" required>

        <label for="date"><b>date</b></label>
        <input type="date" name="date" value="<? echo date("Y-m-d")?>" required>

        <label for="time"><b>time</b></label>
        <input type="time" name="time" value="<? echo date("H:i")?>" required>
        <button type="submit">submit</button>
    </form>
    <? echo date("d/m/Y")?>
    <script>
        const sugar = document.getElementById('sugar');

        sugar.addEventListener('submit', function (e) {

            e.preventDefault();

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
});
    </script>
    <div id="result"></div>
</body>
</html>