<?
include('include/chk_auth.php');
include('../include/stcnn.php');

$pid = $_GET['pid'];
$tid = $_GET['tid'];

if ($_POST['submit'] == 'Edit'){
	$u_date 			= 	$_POST['date'];
	$u_side 			= 	$_POST['side'];
	$u_target_angle 	= 	$_POST['target_angle'];
	$u_number_of_round	= 	$_POST['number_of_round'];
	$u_is_abf			=	$_POST['is_abf'];

	$sql = "update task set date = '$u_date', side = '$u_side', target_angle = '$u_target_angle', 
			number_of_round = '$u_number_of_round', is_abf = '$u_is_abf', status = 'e' where tid = $tid";
	mysql_query($sql);

	header('Location: tasks.php?pid=' . $pid);
	exit();
}

$sql = "select * from task where tid = $tid";
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)){
	$date 				= 	$row['date'];
	$side 				= 	$row['side'];
	$target_angle 		= 	$row['target_angle'];
	$number_of_round	=	$row['number_of_round'];
	$is_abf 			= 	$row['is_abf'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Edit Task</title>
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
				<div class="headline">Edit Task (TID: <?=$tid?>)</div>
				<div class="sub_headline">
					<a href="tasks.php?pid=<?=$pid?>">&lt;&lt; Go back to Tasks List</a>
				</div>
			</div>
			
			<form action="" method="post" id="form">
				<div class="form_row">
					<div class="label">Date</div>
					<div class="value">
						<input type="text" name="date" id="datepicker" value="<?=date("Y/m/d", strtotime($date))?>" class="input" />
					</div>
				</div>

				<div class="form_row">
					<div class="label">Arm Side</div>
					<div class="value">
						<label class="select_label">
							<select name="side" class="select">
								<option value="l"<?=($side=='l')?' selected':''?>>Left</option>
								<option value="r"<?=($side=='r')?' selected':''?>>Right</option>
							</select>
						</label>
					</div>
				</div>

				<div class="form_row">
					<div class="label">Target Angle</div>
					<div class="value">
						<input type="number" name="target_angle" min="30" max="180" value="<?=$target_angle?>" class="input num" />
						<span class="note">(min: 30&deg; / max: 180&deg;)</span>
					</div>
				</div>

				<div class="form_row">
					<div class="label">Number of Round</div>
					<div class="value">
						<input type="number" name="number_of_round" min="1" max="99" value="<?=$number_of_round?>" class="input num" />
						<span class="note">(min: 1 / max: 99)</span>
					</div>
				</div>

				<div class="form_row">
					<div class="label">ABF</div>
					<div class="value" style="padding: 10px 0;">
						<input type="radio" name="is_abf" id="is_abf" value="y"<?=($is_abf=='y')?' checked="checked"':''?> /><label for="is_abf"> Yes</label> &nbsp;&nbsp;
						<input type="radio" name="is_abf" id="is_not_abf" value="n"<?=($is_abf!='y')?' checked="checked"':''?> /><label for="is_not_abf"> No</label>
					</div>
				</div>

				<div class="form_row option">
					<input type="submit" name="submit" value="Edit" class="btn create_task" />
					<input type="hidden" name="tid" value="<?=$tid?>" />
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
			defaultDate: '<?=date("Y/m/d", strtotime($date))?>',
 			minDate:'0'
		});
	});
	</script>
</body>
</html>