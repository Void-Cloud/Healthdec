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
        $_SESSION['offset'] = 0;
        $rows = count($res);
    }
    else{
        $rows = 15;
        switch($_POST['offset']){
            case 0:
                $_SESSION['offset'] = 0;
                break;
            case 1: 
                if($_SESSION['offset'] + 15 > count($res) - 15 ){
                    $_SESSION['offset'] = count($res) - 15;
                }
                else{
                    $_SESSION['offset'] = $_SESSION['offset'] + 15;
                }
                break;
            case 2:
                if($_SESSION['offset'] - 15 < 0){
                    $_SESSION['offset'] = 0;
                }
                else{
                    $_SESSION['offset'] = $_SESSION['offset'] - 15;
                }
                break;
            default:
                $_SESSION['offset'] = 0;
                
        }
    }
?>

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Blood Glucose"
	},
	axisX: {
		title: "Date"
	},
	axisY: {
		title: "",
		includeZero: false,
		suffix: " °C"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeries
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Systolic",
		type: "spline",
		yValueFormatString: "0.0 #.# mmHg",
		showInLegend: true,
        dataPoints: [
<?
			for($i = $rows + $_SESSION['offset'] -1; $i >= $_SESSION['offset']; $i--){
                $day = substr($res[$i][1], -2, 2);
                $month = substr($res[$i][1], -5, 2);
                $year = substr($res[$i][1], -10, 4);
                $hour = substr($res[$i][2], -8, 2);
                $minute = substr($res[$i][2], -5, 2);
                $value = $res[$i][3];
                echo "{ 'label': '". $day .".". $month .".". $year ." ". $hour . ":". $minute ."', y: ". $value . " },";
            }
?>			
		]
	},
	{
		
	}]
});
chart.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

