<?
include('include/chk_auth.php');
include('../include/stcnn.php');

if ($_POST['submit'] == 'Create'){
	$sql = "insert into patient (firstname, lastname, username, password, email, gender, dob) values (";
	$sql .= "'" . $_POST['firstname'] . "'";
	$sql .= ",'" . $_POST['lastname'] . "'";
	$sql .= ",'" . $_POST['username'] . "'";
	$sql .= ",'" . md5($_POST['password']) . "'";
	$sql .= ",'" . $_POST['email'] . "'";
	$sql .= ",'" . $_POST['gender'] . "'";
	$sql .= ",'" . $_POST['dob'] . "'";
	$sql .= ")";
	mysql_query($sql);

	$pid = mysql_insert_id();
	$side = $_POST['side'];
	$is_abf = 'y';

	$angles = array('90', '120', '150');

	foreach ($angles as $angle){
		$sql = "insert into task (pid, date, side, target_angle, number_of_round, is_abf, status) values(";
		$sql .= "'" . $pid . "'";
		$sql .= ",'2015-01-30'";
		$sql .= ",'" . $side . "'";
		$sql .= ",'" . $angle . "'";
		$sql .= ",'10'";
		$sql .= ",'" . $is_abf . "'";
		$sql .= ",'c'";
		$sql .= ")";
		mysql_query($sql);
	}

	$is_abf = 'n';
	foreach ($angles as $angle){
		$sql = "insert into task (pid, date, side, target_angle, number_of_round, is_abf, status) values(";
		$sql .= "'" . $pid . "'";
		$sql .= ",'2015-01-30'";
		$sql .= ",'" . $side . "'";
		$sql .= ",'" . $angle . "'";
		$sql .= ",'10'";
		$sql .= ",'" . $is_abf . "'";
		$sql .= ",'c'";
		$sql .= ")";
		mysql_query($sql);
	}

	header('Location: select_patient.php');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Create Patient</title>
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
				<div class="headline">Create Patient</div>
				<div class="sub_headline">
					<a href="select_patient.php">&lt;&lt; Go back to Patients List</a>
				</div>
			</div>
			
			<form action="" method="post" id="form">
				<div class="form_row">
					<div class="label">Username</div>
					<div class="value">
						<input type="text" name="username" class="input" />
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
						<input type="text" name="firstname" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Last Name</div>
					<div class="value">
						<input type="text" name="lastname" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">E-mail</div>
					<div class="value">
						<input type="text" name="email" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Date of Birth</div>
					<div class="value">
						<input type="text" name="dob" id="datepicker" value="<?=date('Y/m/d', strtotime('01/01/1990'))?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Gender</div>
					<div class="value" style="padding: 10px 0;">
						<input type="radio" name="gender" id="male" value="m" checked="checked" /> <label for="male">Male</label> &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="gender" id="female" value="f" /> <label for="female">Female</label>
					</div>
				</div>

				<div class="form_row">
					<div class="label">Side</div>
					<div class="value" style="padding: 10px 0;">
						<input type="radio" name="side" id="side_l" value="l" checked="checked" /> <label for="side_l">Left</label> &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="side" id="side_r" value="r" /> <label for="side_r">Right</label>
					</div>
				</div>

				<div class="form_row option">
					<input type="submit" name="submit" value="Create" class="btn create_task" />
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