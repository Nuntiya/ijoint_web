<?
include('include/chk_auth.php');
include('../include/stcnn.php');

$pid = $_GET['pid'];
$tid = $_GET['tid'];

$sql = "select * from patient where pid = $pid";
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)){
	$gender = (($row['gender']=='f')?'fe':'') . 'male';
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$age = date_diff(date_create($row['dob']), date_create('today'))->y;
}

$sql = "select * from task where tid = $tid";
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)){
	$task_date 				= $row['date'];
	$task_side 				= $row['side'];
	$task_target_angle 		= $row['target_angle'];
	$task_number_of_round 	= $row['number_of_round'];
	$task_perform_datetime	= $row['perform_datetime'];
	$task_isABF				= $row['is_abf'];
	$task_score				= $row['score'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Result</title>
	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/result.css">
</head>

<body>
	<div class="container">
		<? include('include/header.php'); ?>

		<a href="sign_out.php" id="sign_out_btn" class="btn">
			Sign Out
		</a>

		<div id="body">
			<div id="change_patient">
				<a href="tasks.php?pid=<?=$pid?>">&lt;&lt; Go back to Task List</a>
			</div>

			<div id="patient" class="element box">
				<div class="patient_info">
					<div class="patient_gender">
						<img src="images/icon-<?=$gender?>.png" class="circle" />
					</div>
					<div class="patient_name"><?=$firstname . ' ' . $lastname?> <span class="age"><?=$age?> yrs old</span></div>
				</div>
			</div>

			<div id="task_info" class="element">
				<?=($task_isABF == 'y')?'<div class="abf_bg"></div><div class="abf">ABF</div>':''?>

				<div class="date"><?=strtoupper(date('d M Y', strtotime($task_date)))?></div>
				
				<div class="side">
					<div class="label">ARM SIDE</div>
					<div class="value"><?=($task_side=='l')?'Left':'Right'?></div>
				</div>

				<div class="target_angle">
					<div class="label">TARGET ANGLE</div>
					<div class="value"><?=$task_target_angle?>&deg;</div>
				</div>

				<div class="num_of_round">
					<div class="label">ROUND</div>
					<div class="value"><?=$task_score?> <span class="small">/ <?=$task_number_of_round?></span></div>
				</div>

				<div class="perform_datetime">
					<div class="label">PERFORM DATETIME</div>
					<div class="value"><?=strtoupper(date('d M Y | H:i', strtotime($task_perform_datetime)))?></div>
				</div>
			</div>

			<div id="chartContainer"></div>

			<table id="item_table" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<td>#</td>
						<td>Time (s)</td>
						<td>Angle</td>
					</tr>
				</thead>

				<tbody>
					<?
					$time_list = array();
					$angle_list = array();
					$peek_list = array();

					$SQL = "SELECT * FROM result_item WHERE tid = $tid ORDER BY iid ASC";
					$query = mysql_query($SQL);
					$i = 1;
					while ($row = mysql_fetch_array($query)){
						$time_list[] = number_format( ($row['time']/1000), 1);
						$angle_list[] = $row['angle'];

						if ($i>1 && $isIncreasing && $row['angle'] < $last_angle){
							$peek = array('time'=>number_format( ($row['time']/1000), 1), 'angle'=>$row['angle']);
							$peek_list[] = $peek;
							$isIncreasing = false;
						}
						else if ($i>1 && $row['angle'] >= $last_angle){
							$isIncreasing = true;
						}
						$last_angle = $row['angle'];
						$i++;
					}

					foreach ($peek_list as $i => $peek){
					?>
					<tr>
						<td><?=$i+1?></td>
						<td><?=$peek['time']?></td>
						<td><?=$peek['angle']?></td>
					</tr>
					<? } ?>
				</tbody>
			</table>
		</div>

		<? include('include/footer.php'); ?>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/fusioncharts.js"></script>
	<script src="js/fusioncharts.charts.js"></script>
	<script src="js/themes/fusioncharts.theme.fint.js"></script>
	<script>
	$(function(){
		$('.del').on('click', function(e){
			e.preventDefault();
			tid = $(this).attr('data-tid');

			if (confirm("Are you sure you want to delete this task?"))
				window.location = 'delete_task.php?pid=<?=$pid?>&tid=' + tid;
		});
	});
	</script>
	<script>
		FusionCharts.ready(function(){
		    var revenueChart = new FusionCharts({
		        "type": "msline",
		        "renderAt": "chartContainer",
		        "width": "100%",
		        "height": "550",
		        "dataFormat": "json",
		        "dataSource": {
		        	"chart": {
		              "xAxisName": "Time (second)",
		              "yAxisName": "Angle (degrees)",
		              "theme": "fint",
		              "showValues": "0"
		        	},
		        	"categories": [
				      {
				         "category": [
				         	<?
				         	foreach ($peek_list as $k => $peek){
				         	?>
				            {
				               "label": "<?=$peek['time']?>"
				            }
				            <?
				            	if ($k != count($peek_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      }
				   ],
				   "dataset": [
				      {
				         "data": [
				         	<?
				         	foreach ($peek_list as $k => $peek){
				         	?>
				            {
				               "value": "<?=$peek['angle']?>"
				            }
				            <?
				            	if ($k != count($peek_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      }
				   ]
		        }
		    });

		    revenueChart.render();
		})
		</script>
</body>
</html>