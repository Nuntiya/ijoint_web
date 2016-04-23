<?
include('../../include/stcnn.php');

$json = json_decode(stripslashes($_POST['json']));

$perform_datetime = $json->performDateTime;
$tasks = $json->result;

foreach ($tasks as $key => $task){
	$time = $task->time;
	$azimuth = $task->azimuth;
	$pitch = $task->pitch;
	$roll = $task->roll;
	$accX = $task->accX;
	$accY = $task->accY;
	$accZ = $task->accZ;

	$sql = "insert into accelerometer_data (performDateTime, time, azimuth, pitch, roll, accX, accY, accZ) values (";
	$sql .= "'" . $perform_datetime . "'";
	$sql .= ",'" . $time . "'";
	$sql .= ",'" . $azimuth . "'";
	$sql .= ",'" . $pitch . "'";
	$sql .= ",'" . $roll . "'";
	$sql .= ",'" . $accX . "'";
	$sql .= ",'" . $accY . "'";
	$sql .= ",'" . $accZ . "'";
	$sql .= ")";
	mysql_query($sql);
}
?>