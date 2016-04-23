<?
include('../../include/stcnn.php');

$list = $_POST['tid_list'];

$sql = "update task set status = 's' where tid in ($list)";
mysql_query($sql);
?>