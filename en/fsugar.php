<?php
    session_start();

    $config = parse_ini_file("../../../env.ini");

    $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

    if($connection === false){
        die( "Database connection failed :(" );
    }

    if(!($stmt = $connection->prepare("SELECT * from Measure WHERE Type = 1 AND Id = (?) ORDER BY date DESC, time DESC"))){
        echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("i", $_SESSION['id'])){
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    if(!($res = $stmt->get_result())) {
        echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $res = $res->fetch_all();

    if(count($res) <= 15){
        $_SESSION['bsoffset'] = 0;
        $rows = count($res);
    }
    else{
        $rows = 15;
        switch($_POST['bsoffset']){
            case 0:
                $_SESSION['bsoffset'] = 0;
                break;
            case 1: 
                if($_SESSION['bsoffset'] + 15 > count($res) - 15 ){
                    $_SESSION['bsoffset'] = count($res) - 15;
                }
                else{
                    $_SESSION['bsoffset'] = $_SESSION['bsoffset'] + 15;
                }
                break;
            case 2:
                if($_SESSION['bsoffset'] - 15 < 0){
                    $_SESSION['bsoffset'] = 0;
                }
                else{
                    $_SESSION['bsoffset'] = $_SESSION['bsoffset'] - 15;
                }
                break;
            default:
                $_SESSION['bsoffset'] = 0;
                
        }
    }
    echo "<table style='width:100%'><tr><th>Date</th><th>Time</th><th>Value</th></tr>";
    for($i = $_SESSION['bsoffset']; $i < $rows + $_SESSION['bsoffset']; $i++){
        echo "<tr><td>". substr($res[$i][1], -2, 2). ".". substr($res[$i][1], -5, 2). ".". substr($res[$i][1], -10, 4). "</td><td>".substr($res[$i][2], -8, 2). ":".substr($res[$i][2], -5, 2)."</td><td>". $res[$i][3]. "</td></tr>";
    }
    echo "</table>";
?>