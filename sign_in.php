<?
include('../include/stcnn.php');

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "select * from admin_user where username = '" . $username . "' and password = '" . $password . "'";
$query = mysql_query($sql);
$nr = mysql_num_rows($query);

if ($nr > 0){
	session_start();
	$_SESSION['admin_user'] = $username;

	header('Location: select_patient.php');
	exit();
}
else{
	header('Location: index.php');
	exit();
}
?>