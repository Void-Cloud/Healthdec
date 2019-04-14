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

        if(!($stmt = $connection->prepare("SELECT * from User WHERE Email = (?)"))){
            echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!$stmt->bind_param("s", $email)){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if(!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $res = $res->fetch_all();
        if($res[0][1] == $email){
            if(password_verify($pass, $res[0][0])){
                
                session_start();
                $_SESSION['name'] = $email;
                $_SESSION['id'] = $res[0][2];
                $_SESSION['height'] = $res[0][3];

                echo "Success!";
            }
            else{
                echo "Email or password is incorrect";
            }
            
        }
        else{
            echo "Email or password is incorrect";
        }
        $stmt->close();
        $connection->close();
    }
?>