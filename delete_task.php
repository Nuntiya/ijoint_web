<?
include('include/chk_auth.php');
include('../include/stcnn.php');

$pid = $_GET['pid'];
$tid = $_GET['tid'];

$sql = "update task set status = 'x' where tid = $tid";
mysql_query($sql);

header('Location: tasks.php?pid=' . $pid);
exit();
?>