<?
include('include/chk_auth.php');
include('../include/stcnn.php');

$pid = $_GET['pid'];

$sql = "select * from patient where pid = $pid";
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)){
	$gender = (($row['gender']=='f')?'fe':'') . 'male';
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$age = date_diff(date_create($row['dob']), date_create('today'))->y;

	$num_complete_task = 0;
	$sql_task = "select * from task where pid = $pid and status <> 'x' order by date desc, tid desc";
	$query_task = mysql_query($sql_task);
	$num_all_task = mysql_num_rows($query_task);
	$query_task = mysql_query($sql_task);
	while ($row_task = mysql_fetch_array($query_task)){
		$t['tid'] = $row_task['tid'];
		$t['pid'] = $row_task['pid'];
		$t['date'] = $row_task['date'];
		$t['side'] = $row_task['side'];
		$t['target_angle'] = $row_task['target_angle'];
		$t['number_of_round'] = $row_task['number_of_round'];
		$t['is_abf'] = $row_task['is_abf'];
		$t['status'] = $row_task['status'];
		$tasks[] = $t;

		if ($row_task['status'] == 'd')
			$num_complete_task++;
	}

	$stat = number_format($num_complete_task*100/$num_all_task);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Task Management</title>
	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/tasks.css">
</head>

<body>
	<div class="container">
		<? include('include/header.php'); ?>

		<a href="sign_out.php" id="sign_out_btn" class="btn">
			Sign Out
		</a>

		<div id="body">
			<div id="patient" class="element box">
				<div class="patient_info">
					<div class="patient_gender">
						<img src="images/icon-<?=$gender?>.png" class="circle" />
					</div>
					<div class="patient_name"><?=$firstname . ' ' . $lastname?> <span class="age"><?=$age?> yrs old</span></div>
					<a href="edit_patient.php?pid=<?=$pid?>" class="edit_btn"></a>
				</div>
				<div class="patient_stat">
					<div class="label">Progress</div>
					<div class="bar"><div class="grey_bar"><div class="complete_bar" style="width: <?=$stat?>%;"></div></div></div>
					<div class="stat"><?=$stat?>%</div>
				</div>
			</div>
			<div id="change_patient">
				<a href="select_patient.php">Select another patient</a>
			</div>

			<div id="task">
				<div class="head">
					<div class="headline">Tasks</div>
					<div class="sub_headline">Manage the task for <?=$firstname?></div>
					<a href="create_task.php?pid=<?=$pid?>" class="btn create_task">Create Task</a>
				</div>
				
				<div class="list">
					<?
					foreach ($tasks as $task){
						$side = ($task['side'] == 'l')?'Left':'Right';
						$status = $task['status'];
						$status_icon = ($task['status'] == 'd')?'complete':'progress';
					?>
					<div class="element<?=($status=='d')?' complete':''?>">
						<?=($task['is_abf'] == 'y')?'<div class="abf_bg"></div><div class="abf">ABF</div>':''?>
						<div class="date"><?=strtoupper(date('d M Y', strtotime($task['date'])))?></div>
						
						<div class="side">
							<div class="label">ARM SIDE</div>
							<div class="value"><?=$side?></div>
						</div>

						<div class="target_angle">
							<div class="label">TARGET ANGLE</div>
							<div class="value"><?=$task['target_angle']?>&deg;</div>
						</div>

						<div class="num_of_round">
							<div class="label">NUMBER OF ROUND</div>
							<div class="value"><?=$task['number_of_round']?></div>
						</div>

						<div class="check">
							<img src="images/icon-<?=$status_icon?>.png" />
						</div>

						<div class="option">
							<a href="result.php?pid=<?=$pid?>&tid=<?=$task['tid']?>" class="btn<?=($status!='d')?' disabled':' result'?>">Result</a>
							<a href="edit_task.php?pid=<?=$pid?>&tid=<?=$task['tid']?>" class="btn<?=($status=='d')?' disabled':''?>">Edit</a>
							<a class="btn del" data-tid="<?=$task['tid']?>">Delete</a>
						</div>
					</div>
					<? } ?>

					<? if (count($tasks) == 0){ ?>
					<div class="element notask">
						Don't have any task yet
					</div>
					<? } ?>
				</div>
			</div>
		</div>

		<? include('include/footer.php'); ?>
	</div>
	
	<script src="js/jquery.js"></script>
	<script>
	$(function(){
		$('.disabled').on('click', function(e){
			e.preventDefault();
		});

		$('.del').on('click', function(e){
			e.preventDefault();
			tid = $(this).attr('data-tid');

			if (confirm("Are you sure you want to delete this task?"))
				window.location = 'delete_task.php?pid=<?=$pid?>&tid=' + tid;
		});
	});
	</script>
</body>
</html>