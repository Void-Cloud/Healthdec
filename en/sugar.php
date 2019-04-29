<?php
    session_start();

    $value = htmlentities($_POST["bloodsugar"]);
    $date = htmlentities($_POST["date"]);
    $time = htmlentities($_POST["time"]);

    $year = substr($date, -10, 4);
    $day = substr($date, -2, 2);
    $month = substr($date, -5, 2);
    if(empty($value) || empty($date) || empty($time)){
        echo "please fill the form entirely";
    }
    elseif(!(checkdate($month, $day, $year))){
        echo "Given date is not valid or was given in incorrect form (yyyy-mm-dd)";
    }
    elseif((preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time)) === 0){
        echo "Given date is not valid or was given in incorrect form (hh:mm)";
    }
    elseif((preg_match("/^([0-9][0-9]|[0-9]).[0-9]$/", $value) === 0)){
        echo "Given value is not within accepted range 00.0 - 99.9";
    }
    else{
        $config = parse_ini_file("../../../env.ini");

        $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

        if($connection === false){
            die( "Database connection failed :(" );
        }

        if(!($stmt = $connection->prepare("INSERT INTO Measure VALUES (?, ?, ?, ?, ?, ?)"))){
            echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $id = intval(htmlentities($_SESSION["id"]));
        $type = 1;
        $yay = NULL;
        if (!$stmt->bind_param("isssii", $yay, $date, $time, $value, $type, $id)){
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