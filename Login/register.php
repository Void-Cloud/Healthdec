<?php
    $email = htmlentities($_POST["email"]);
    $pass1 = htmlentities($_POST["psw"]);
    $pass2 = htmlentities($_POST["psw2"]);

    if(empty($email) || empty($pass1)){
        echo "please fill the form entirely";
    }
    elseif($pass1 != $pass2){
        echo "passwords didn't match";
    }
    elseif(preg_match("/[A-Z]/", $pass1)===0 || preg_match("/[0-9]/", $pass1)===0 || strlen($pass1) < 4 || strlen($pass) > 30){
        echo "Password must contain a number, an uppercase letter and must be between 4-30 characters long.";
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
            echo "Email is already registered";
        }
        else{

            if(!($stmt = $connection->prepare("INSERT INTO User VALUES (?, ?, ?, ?)"))){
                echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }
            $stringnull = null;
            $defheight = 0;
            if (!$stmt->bind_param("ssii", password_hash($pass1,PASSWORD_DEFAULT), $email, $stringnull, $defheight)){
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
    
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            else{
                echo "Success!";
            }
            
        }
        $stmt->close();
        $connection->close();
    }