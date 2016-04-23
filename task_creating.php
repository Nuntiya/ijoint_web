<?
include('../include/stcnn.php');

$pid = $_GET['pid'];

$is_abf = ($pid==1)?'y':'n';

$angles = array('90', '120', '150');

foreach ($angles as $angle){
	$sql = "insert into task (pid, date, side, target_angle, number_of_round, is_abf, status) values(";
	$sql .= "'" . $pid . "'";
	$sql .= ",'2015-01-30'";
	$sql .= ",'l'";
	$sql .= ",'" . $angle . "'";
	$sql .= ",'10'";
	$sql .= ",'" . $is_abf . "'";
	$sql .= ",'c'";
	$sql .= ")";
	mysql_query($sql);
}

foreach ($angles as $angle){
	$sql = "insert into task (pid, date, side, target_angle, number_of_round, is_abf, status) values(";
	$sql .= "'" . $pid . "'";
	$sql .= ",'2015-01-30'";
	$sql .= ",'r'";
	$sql .= ",'" . $angle . "'";
	$sql .= ",'10'";
	$sql .= ",'" . $is_abf . "'";
	$sql .= ",'c'";
	$sql .= ")";
	mysql_query($sql);
}

header("Location: task_creator.php");
exit();
?>