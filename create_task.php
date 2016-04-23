<?
include('include/chk_auth.php');
include('../include/stcnn.php');

$pid = $_GET['pid'];

if ($_POST['submit'] == 'Create'){
	$sql = "insert into task (pid, date, side, target_angle, number_of_round, is_abf, status) values (";
	$sql .= "'" . $_POST['pid'] . "'";
	$sql .= ",'" . $_POST['date'] . "'";
	$sql .= ",'" . $_POST['side'] . "'";
	$sql .= ",'" . $_POST['target_angle'] . "'";
	$sql .= ",'" . $_POST['number_of_round'] . "'";
	//$sql .= ",'" . $_POST['is_abf'] . "'";
	$sql .= ",'n'";
	$sql .= ",'c'";
	$sql .= ")";
	mysql_query($sql);

	header('Location: tasks.php?pid=' . $pid);
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Create Task</title>
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
				<div class="headline">Create Task</div>
				<div class="sub_headline">
					<a href="tasks.php?pid=<?=$pid?>">&lt;&lt; Go back to Tasks List</a>
				</div>
			</div>
			
			<form action="" method="post" id="form">
				<div class="form_row">
					<div class="label">Date</div>
					<div class="value">
						<input type="text" name="date" id="datepicker" value="<?=date('Y/m/d', strtotime('+1 day'))?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Arm Side</div>
					<div class="value">
						<label class="select_label">
							<select name="side" class="select">
								<option value="l">Left</option>
								<option value="r">Right</option>
							</select>
						</label>
					</div>
				</div>

				<div class="form_row">
					<div class="label">Target Angle</div>
					<div class="value">
						<input type="number" name="target_angle" min="30" max="180" value="120" class="input num" />
						<span class="note">(min: 30&deg; / max: 180&deg;)</span>
					</div>
				</div>

				<div class="form_row">
					<div class="label">Number of Round</div>
					<div class="value">
						<input type="number" name="number_of_round" min="1" max="99" value="10" class="input num" />
						<span class="note">(min: 1 / max: 99)</span>
					</div>
				</div>

				<div class="form_row">
					<div class="label">ABF</div>
					<div class="value" style="padding: 10px 0;">
						<input type="radio" name="is_abf" id="is_abf" value="y" checked="checked" /><label for="is_abf"> Yes</label> &nbsp;&nbsp;
						<input type="radio" name="is_abf" id="is_not_abf" value="n" /><label for="is_not_abf"> No</label>
					</div>
				</div>

				<div class="form_row option">
					<input type="submit" name="submit" value="Create" class="btn create_task" />
					<input type="hidden" name="pid" value="<?=$pid?>" />
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
			format: 'Y/m/d',
 			minDate:'0'
		});
	});
	</script>
</body>
</html>