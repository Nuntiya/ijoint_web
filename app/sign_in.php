<?
include('../../include/stcnn.php');

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "select * from patient where username = '" . $username . "' and password = '" . $password . "'";
$query = mysql_query($sql);
$nr = mysql_num_rows($query);

if ($nr > 0){
	$result['status'] = true;

	$query = mysql_query($sql);
	while ($row = mysql_fetch_array($query)){
		$result['pid'] = $row['pid'];
		$result['pFirstName'] = $row['firstname'];
		$result['pLastName'] = $row['lastname'];
	}
}
else{
	$result['status'] = false;
}

echo json_encode($result);
?>