<?php
    session_start();

    $value1 = htmlentities(strval($_POST["systolic"]));
    $value2 = htmlentities(strval($_POST["diastolic"]));
    $date = htmlentities($_POST["date"]);
    $time = htmlentities($_POST["time"]);

    $year = substr($date, -10, 4);
    $day = substr($date, -2, 2);
    $month = substr($date, -5, 2);
    if(empty($value1) || empty($date) || empty($time || empty($value2))){
        echo "please fill the form entirely";
    }
    elseif(!(checkdate($month, $day, $year))){
        echo "Given date is not valid or was given in incorrect form (yyyy-mm-dd)";
    }
    elseif((preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time)) === 0){
        echo "Given time is not valid or was given in incorrect form (hh:mm)";
    }
    elseif((preg_match("/^([0-9][0-9][0-9]|[0-9][0-9])$/", $value1) === 0)){
        echo "Given systolic value is not within accepted range 0 - 999";
    }
    elseif((preg_match("/^([0-9][0-9][0-9]|[0-9][0-9])$/", $value2) === 0)){
        echo "Given diastolic value is not within accepted range 0 - 999";
    }
    elseif(strtotime($date . $time) > strtotime('+45 minutes')){
        echo "you can't set values to further than 45 minutes in to the future.";
    }
    else{

        $fvalue = $value1 . "/" . $value2;

        $config = parse_ini_file("../../../env.ini");

        $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

        if($connection === false){
            die( "Database connection failed :(" );
        }

        if(!($stmt = $connection->prepare("INSERT INTO Measure VALUES (?, ?, ?, ?, ?, ?)"))){
            echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $id = intval(htmlentities($_SESSION["id"]));
        $type = 2;
        $yay = NULL;
        if (!$stmt->bind_param("isssii", $yay, $date, $time, $fvalue, $type, $id)){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        /*if(!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $res = $res->fetch_all();*/
        echo "data entered succesfully!";


        $stmt->close();
        $connection->close();
    }
?>