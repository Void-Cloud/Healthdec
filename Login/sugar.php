<?php
    $email = htmlentities($_POST["email"]);
    $pass = htmlentities($_POST["psw"]);


    if(empty($email) || empty($pass)){
        echo "please fill the form entirely";
    }
    else{
        $config = parse_ini_file("../../../env.ini");

        $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

        if($connection === false){
            die( "Database connection failed :(" );
        }

        if(!($stmt = $connection->prepare("SELECT * from Measure"))){
            echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        /*if (!$stmt->bind_param("s", $email)){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }*/

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if(!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $res = $res->fetch_all();
        
        
        $stmt->close();
        $connection->close();
    }
?>
<p>oh god why</p>
<? echo "<script>

var myNum = 1;

document.write(myNum);

</script>"?>