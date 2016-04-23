<?
include('include/chk_auth.php');
include('../include/stcnn.php');

if ($_POST['submit'] == 'Create'){
	$sql = "insert into user (gender, age, perform_datetime) values (";
	$sql .= "'" . $_POST['gender'] . "'";
	$sql .= ",'" . $_POST['age'] . "'";
	$sql .= ",NOW()";
	$sql .= ")";
	mysql_query($sql);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Create User</title>
	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/create_task.css">
</head>

<body>
	<div class="container">
		<? include('include/header.php'); ?>

		<div id="create_task">
			<div class="head">
				<div class="headline">Create User</div>
			</div>
			
			<form action="" method="post" id="form">
				<div class="form_row">
					<div class="label">Age</div>
					<div class="value">
						<input type="text" name="age" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Gender</div>
					<div class="value" style="padding: 10px 0;">
						<input type="radio" name="gender" id="male" value="m" checked="checked" /> <label for="male">Male</label> &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="gender" id="female" value="f" /> <label for="female">Female</label>
					</div>
				</div>

				<div class="form_row option">
					<input type="submit" name="submit" value="Create" class="btn create_task" />
				</div>
			</form>
		</div>
	</div>
</body>
</html>