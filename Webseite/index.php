<!DOCTYPE html>
<html lang="de" class="no-js">
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
	</head>
	<body>
		<div class="container">
			<!-- Top Navigation -->
			<header>
				<h1>Bewässerung <span>Home</span></h1>	
				<nav class="codrops-demos">
					<a class="current-demo" href="index.php" title="Home">Home</a>
					<a href="s1.php" title="Home">Sensor 1</a>
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
				<h2>Sensor 2:</h2>
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
					$sql = mysql_query("SELECT * FROM bewaesserung WHERE id=(select max(id) from bewaesserung where name LIKE 'Sensor2')") or die(mysql_error());		
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
			</div>
		</div><!-- /container -->
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="js/jquery.stickyheader.js"></script>
	</body>
</html>