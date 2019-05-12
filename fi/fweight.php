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
        $_SESSION['weoffset'] = 0;
        $rows = count($res);
    }
    else{
        $rows = 15;
        switch($_POST['weoffset']){
            case 0:
                $_SESSION['weoffset'] = 0;
                break;
            case 1: 
                if($_SESSION['weoffset'] + 15 > count($res) - 15 ){
                    $_SESSION['weoffset'] = count($res) - 15;
                }
                else{
                    $_SESSION['weoffset'] = $_SESSION['weoffset'] + 15;
                }
                break;
            case 2:
                if($_SESSION['weoffset'] - 15 < 0){
                    $_SESSION['weoffset'] = 0;
                }
                else{
                    $_SESSION['weoffset'] = $_SESSION['weoffset'] - 15;
                }
                break;
            default:
                $_SESSION['weoffset'] = 0;
                
        }
    }
?>

var chart = new CanvasJS.Chart("wevc", {
	animationEnabled: true,
	title:{
		text: "Paino"
	},
	axisX: {
        labelMaxWidth: "75",
		title: "Date"
	},
	axisY: {
		title: "",
		includeZero: false,
		suffix: "  Kiloa"
	},
	legend:{
		cursor: "pointer",
		fontSize: 0,
		itemclick: toggleDataSeries
	},
	toolTip:{
		shared: true
	},
	data: [{
        name: "Paino",
		type: "spline",
		yValueFormatString: "0.0 Kg",
		showInLegend: true,
        dataPoints: [
<?
			for($i = $rows + $_SESSION['weoffset'] -1; $i >= $_SESSION['weoffset']; $i--){
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

