<?php
    session_start();

    $config = parse_ini_file("../../../env.ini");

    $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

    if($connection === false){
        die( "Database connection failed :(" );
    }

    if(!($stmt = $connection->prepare("SELECT * from Measure WHERE Type = 3 AND Id = (?) ORDER BY date DESC, time DESC"))){
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
    echo "<table style='width:100%'><tr><th>Date</th><th>Time</th><th>Value</th></tr>";
    for($i = $_SESSION['weoffset']; $i < $rows + $_SESSION['weoffset']; $i++){
        echo "<tr><td>". substr($res[$i][1], -2, 2). ".". substr($res[$i][1], -5, 2). ".". substr($res[$i][1], -10, 4). "</td><td>".substr($res[$i][2], -8, 2). ":".substr($res[$i][2], -5, 2)."</td><td>". $res[$i][3]. "</td></tr>";
    }
    echo "</table>";
?>