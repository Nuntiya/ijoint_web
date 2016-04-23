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
		$gyroX = $task->gyroX;
		$gyroY = $task->gyroY;
		$gyroZ = $task->gyroZ;
		$magX = $task->magX;
		$magY = $task->magY;
		$magZ = $task->magZ;

	$sql = "insert into rotation_vector (performDateTime, time, azimuth, pitch, roll, accX, accY, accZ, gyroX, gyroY, gyroZ, magX, magY, magZ) values (";
	$sql .= "'" . $perform_datetime . "'";
	$sql .= ",'" . $time . "'";
	$sql .= ",'" . $azimuth . "'";
	$sql .= ",'" . $pitch . "'";
	$sql .= ",'" . $roll . "'";
		$sql .= ",'" . $accX . "'";
		$sql .= ",'" . $accY . "'";
		$sql .= ",'" . $accZ . "'";
		$sql .= ",'" . $gyroX . "'";
		$sql .= ",'" . $gyroY . "'";
		$sql .= ",'" . $gyroZ . "'";
		$sql .= ",'" . $magX . "'";
		$sql .= ",'" . $magY . "'";
		$sql .= ",'" . $magZ . "'";
	$sql .= ")";
	mysql_query($sql);
}
?>