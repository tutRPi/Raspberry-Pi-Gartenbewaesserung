<?php

include( 'funktionenpdoS1.inc.php' );
	
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Bewässerung</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		
		<script>
		window.onload = function () {
		 
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			//exportEnabled: true,
			zoomEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Temperatur"
			},
			axisY:{
				title: "Grad",
				titleFontColor: "#4F81BC",
				suffix : " °",
				tickColor: "#4F81BC"
			},
			axisX:{
				title: "Datum"
			},
			data: [{
				type: "spline", //change type to bar, line, area, pie, etc  
				name: "speed",
				yValueFormatString: "#,##0.00 °",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		
		var chart = new CanvasJS.Chart("chartContainer1", {
			animationEnabled: true,
			//exportEnabled: true,
			zoomEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Feuchtigkeit"
			},
			axisY:{
				title: "Feuchtigkeit",
				titleFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisX:{
				title: "Datum",
				

			},
			data: [{
				type: "spline", //change type to bar, line, area, pie, etc  
				name: "speed",
				yValueFormatString: "#,##0.00",
				dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		
		var chart = new CanvasJS.Chart("chartContainer2", {
			animationEnabled: true,
			//exportEnabled: true,
			zoomEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Helligkeit"
			},
			axisY:{
				title: "Helligkeit",
				titleFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisX:{
				title: "Datum",
				

			},
			data: [{
				type: "spline", //change type to bar, line, area, pie, etc  
				name: "speed",
				yValueFormatString: "#,##0.00",
				dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		
		var chart = new CanvasJS.Chart("chartContainer3", {
			animationEnabled: true,
			//exportEnabled: true,
			zoomEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Leitfähigkeit"
			},
			axisY:{
				title: "Leitfähigkeit",
				titleFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisX:{
				title: "Datum",
				

			},
			data: [{
				type: "spline", //change type to bar, line, area, pie, etc  
				name: "speed",
				yValueFormatString: "#,##0.00",
				dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		
		var chart = new CanvasJS.Chart("chartContainer4", {
			animationEnabled: true,
			//exportEnabled: true,
			zoomEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Batterie"
			},
			axisY:{
				title: "Batterie",
				titleFontColor: "#4F81BC",
				tickColor: "#4F81BC"
				//maximum: 100
			},
			axisX:{
				title: "Datum",
				

			},
			data: [{
				type: "spline", //change type to bar, line, area, pie, etc  
				name: "speed",
				yValueFormatString: "#,##0.00 %",
				dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		 
		}
</script>
	</head>
	<body>
		<div class="container">
			<!-- Top Navigation -->
			<header>
				<h1>Bewässerung <span>Home</span></h1>	
				<nav class="codrops-demos">
					<a href="index.php" title="Home">Home</a>
					<a class="current-demo" href="s1.php" title="Home">Sensor 1</a>
					<a href="s2.php" title="Home">Sensor 2</a>
				</nav>
			</header>
			<div class="component">
				<?php
				date_default_timezone_set("Europe/Berlin");
				$timestamp = time();
				
				$datum = date("d.m.Y",$timestamp);
				?>
				<h2>Sensor 1:</h2>
				<table>
					<thead>
						<tr>
							<th>Letzte Messung</th>
							<th>Nr.</th>
							<th>Temperatur</th>
							<th>Feuchtigkeit</th>
							<th>Helligkeit</th>
							<th>Leitfähigkeit</th>
							<th>Batteriestatus</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					include( 'funktionen.inc.php' );
					$conid = db_connect();
					$sql = mysql_query("SELECT * FROM bewaesserung WHERE id=(select max(id) from bewaesserung where name LIKE 'Sensor1')") or die(mysql_error());		
					while ($row = mysql_fetch_array($sql)) 
					{
						echo	"<tr>";
						echo	"<td class=\"user-name\">".$row['datum']." ".$row['zeit']."</td>";
						echo	"<td class=\"user-name\">".$row['id']."</td>";
						echo	"<td class=\"user-name\">".$row['temp']." °</td>";
						echo	"<td class=\"user-name\">".$row['feucht']."</td>";
						echo	"<td class=\"user-name\">".$row['light']."</td>";
						echo	"<td class=\"user-name\">".$row['leit']."</td>";
						echo	"<td class=\"user-name\">".$row['battery']." %</td>";
						echo	"</tr>";
					}
					
					?>
					</tbody>
				</table>
				<br>
				<h2>Statistik:</h2>
				<br>
				<div id="chartContainer" style="height: 370px; width: 100%;"></div>
				<br><br>
				<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
				<br><br>
				<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
				<br><br>
				<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
				<br><br>
				<div id="chartContainer4" style="height: 370px; width: 100%;"></div>

				
			</div>
		</div><!-- /container -->
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="js/jquery.stickyheader.js"></script>
	</body>
</html>