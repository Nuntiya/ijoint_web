<?
include('include/chk_auth.php');
include('../include/stcnn.php');

$pid = $_GET['pid'];

if ($_POST['submit'] == 'Edit'){
	$u_username			= 	$_POST['username'];
	$u_password			= 	$_POST['password'];
	$u_firstname	 	= 	$_POST['firstname'];
	$u_lastname			= 	$_POST['lastname'];
	$u_email			= 	$_POST['email'];
	$u_gender			= 	$_POST['gender'];
	$u_dob				= 	$_POST['dob'];

	$sql = "update patient set ";
	$sql .= "username = '$u_username', ";
	$sql .= "password = '$u_password', ";
	$sql .= "firstname = '$u_firstname', ";
	$sql .= "lastname = '$u_lastname', ";
	$sql .= "email = '$u_email', ";
	$sql .= "gender = '$u_gender', ";
	$sql .= "dob = '$u_dob' ";
	$sql .= "where pid = $pid";
	mysql_query($sql);

	header('Location: tasks.php?pid=' . $pid);
	exit();
}

$sql = "select * from patient where pid = $pid";
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)){
	$username			= 	$row['username'];
	$firstname	 		= 	$row['firstname'];
	$lastname			= 	$row['lastname'];
	$email				= 	$row['email'];
	$gender				= 	$row['gender'];
	$dob				= 	$row['dob'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Edit Patient</title>
	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/create_task.css">
</head>

<body>
	<div class="container">
		<? include('include/header.php'); ?>

		<a href="sign_out.php" id="sign_out_btn" class="btn">
			Sign Out
		</a>

		<div id="create_task">
			<div class="head">
				<div class="headline">Edit Patient (PID: <?=$pid?>)</div>
				<div class="sub_headline">
					<a href="tasks.php?pid=<?=$pid?>">&lt;&lt; Go back to Tasks List</a>
				</div>
			</div>
			
			<form action="" method="post" id="form">
				<div class="form_row">
					<div class="label">Username</div>
					<div class="value">
						<input type="text" name="username" value="<?=$username?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Password</div>
					<div class="value">
						<input type="text" name="password" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">First Name</div>
					<div class="value">
						<input type="text" name="firstname" value="<?=$firstname?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Last Name</div>
					<div class="value">
						<input type="text" name="lastname" value="<?=$lastname?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">E-mail</div>
					<div class="value">
						<input type="text" name="email" value="<?=$email?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Date of Birth</div>
					<div class="value">
						<input type="text" name="dob" id="datepicker" value="<?=date('Y/m/d', strtotime($dob))?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Gender</div>
					<div class="value" style="padding: 10px 0;">
						<input type="radio" name="gender" id="male" value="m"<?=($gender == 'm')?' checked="checked"':''?> /> <label for="male">Male</label> &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="gender" id="female" value="f"<?=($gender == 'f')?' checked="checked"':''?> /> <label for="female">Female</label>
					</div>
				</div>

				<div class="form_row option">
					<input type="submit" name="submit" value="Edit" class="btn create_task" />
				</div>
			</form>
		</div>

		<? include('include/footer.php'); ?>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/jquery.datetimepicker.js"></script>
	<script>
	$(function(){
		$('#datepicker').datetimepicker({
			datepicker: true,
			timepicker:false,
			format: 'Y/m/d'
		});
	});
	</script>
</body>
</html>