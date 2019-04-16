<?php
    require_once('HTTPS.php');
    session_start();
?>
<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
    Value:<br>
    <input type="text" name="value">
    <br>
    <input type="radio" name="datatype" value="bloodpressure" checked> Bloodpressure<br>
    <input type="radio" name="datatype" value="bloodglucose"> Blood Glucose<br>
    <input type="radio" name="datatype" value="weight"> Weight<br>
    <input type="submit" value="Submit">
</form>
<?
        $email = htmlentities($_POST["user"]);
        $pass = htmlentities($_POST["password"]);
    
        if(empty($email) || empty($pass)){
            echo "please fill the form entirely";
        }
?>
