<?php
    session_start();

    $config = parse_ini_file("../../../env.ini");

    $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

    if($connection === false){
        die( "Database connection failed :(" );
    }

    if(!($stmt = $connection->prepare("SELECT * from Measure WHERE Type = 2 AND Id = (?) ORDER BY date DESC, time DESC"))){
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
        $rows = count($res);
    }
    else{
        $rows = 15;
    }
    echo "<table style='width:100%'><tr><th>Päiväys</th><th>Aika</th><th>Yläpaine</th><th>Alapaine</th></tr>";
    for($i = $_SESSION['bpoffset']; $i < $rows + $_SESSION['bpoffset']; $i++){
        $value = explode("/", $res[$i][3]);
        $value1 = $value[0];
        $value2 = $value[1];
        echo "<tr><td>". substr($res[$i][1], -2, 2). ".". substr($res[$i][1], -5, 2). ".". substr($res[$i][1], -10, 4). "</td><td>".substr($res[$i][2], -8, 2). ":".substr($res[$i][2], -5, 2)."</td><td>". $value1. "</td><td>". $value2. "</td></tr>";
    }
    echo "</table>";
?>