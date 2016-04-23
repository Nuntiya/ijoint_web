<?
include('../../include/stcnn.php');

$list = $_POST['tid_list'];
$perform_datetimes = $_POST['perform_datetimes'];

foreach ($list as $key => $elem){
	$perform_datetime = date('Y-m-d', strtotime($perform_datetimes[$key]));

	$sql = "update task set status = 'd' and perform_datetime = '" . $perform_datetime . "' where tid = $elem";
	mysql_query($sql);
}
?>