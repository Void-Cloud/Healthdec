<?php
  require_once('HTTPS.php');

  session_start();
  if($_SESSION['name'] == ""){
      session_destroy();
      header("Location: landing.php");
  }

  $config = parse_ini_file("../../../env.ini");

  $connection = mysqli_connect($config["dbaddr"], $config["username"], $config["password"], $config["dbname"]);

  if($connection === false){
      die( "Database connection failed :(" );
  }

  if(!($stmt = $connection->prepare("DELETE FROM Measure WHERE Id = (?) AND Type = 3 ORDER BY Idm DESC LIMIT 1"))){
      echo "Prepare Failed: (" . $mysqli->errno . ") " . $mysqli->error;
  }
  $id = intval(htmlentities($_SESSION["id"]));
  if (!$stmt->bind_param("i", $id)){
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  echo "Tieto poistettu onnistuneesti.";
?>