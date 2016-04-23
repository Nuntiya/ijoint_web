<?
include('../../include/stcnn.php');

$json = json_decode(stripslashes($_POST['json']));

$score = $json->score;
$perform_datetime = $json->perform_datetime;
$tasks = $json->result;

$tid = $tasks[0]->tid;

$sql = "select * from task where tid = " . $tid;
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)){
	$status = $row['status'];
}

if ($status != "d"){
	foreach ($tasks as $key => $task){
		$time = $task->time;
		$angle = $task->angle;
		$rawAngle = $task->rawAngle;
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

		$sql = "insert into result_item (tid, time, angle, rawAngle, azimuth, pitch, roll, accX, accY, accZ, gyroX, gyroY, gyroZ, magX, magY, magZ) values (";
		$sql .= "'" . $tid . "'";
		$sql .= ",'" . $time . "'";
		$sql .= ",'" . $angle . "'";
		$sql .= ",'" . $rawAngle . "'";
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

	$sql = "update task set status = 'd', perform_datetime = '" . $perform_datetime . "', score = '" . $score . "' where tid = " . $tid;
	mysql_query($sql);
}
?>