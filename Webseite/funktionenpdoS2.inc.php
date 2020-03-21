<?php
 
$dataPoints = array();
$dataPoints1 = array();
$dataPoints2 = array();
$dataPoints3 = array();
$dataPoints4 = array();

try{
    include( 'funktionen-pdo-Sensoren.inc.php' );
	
	// In diesem Script geht es um den Sensor2
    $handle = $link->prepare('select * from bewaesserung where name like "Sensor2"'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
		
        array_push($dataPoints, array("label"=> "".$row->datum." ".$row->zeit."", "y"=> $row->temp));
    }
	foreach($result as $row){
		
        array_push($dataPoints1, array("label"=> "".$row->datum." ".$row->zeit."", "y"=> $row->feucht));
    }
	foreach($result as $row){
		
        array_push($dataPoints2, array("label"=> "".$row->datum." ".$row->zeit."", "y"=> $row->light));
    }
	foreach($result as $row){
		
        array_push($dataPoints3, array("label"=> "".$row->datum." ".$row->zeit."", "y"=> $row->leit));
    }
	foreach($result as $row){
		
        array_push($dataPoints4, array("label"=> "".$row->datum." ".$row->zeit."", "y"=> $row->battery));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
?>