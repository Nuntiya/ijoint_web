<?
include('../../include/stcnn.php');

$pdt = str_replace('%20', ' ', $_GET['pdt']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Result</title>
	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/result.css">
</head>

<body>
	<div class="container">

		<div id="body">
			

			<div id="chartContainer"></div>

			<div style="text-align:center;">
				<span style="color: blue">Raw Angle</span> | <span style="color: green">Azimuth</span> | 
				<span style="color: #FFCC00">Pitch</span> | <span style="color: red">Roll</span>
			</div>

			<table id="item_table" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<td>#</td>
						<td>Time (s)</td>
						<td>rawAngle</td>
						<td>azimuth</td>
						<td>pitch</td>
						<td>roll</td>
						<td>accX</td>
						<td>accY</td>
						<td>accZ</td>
						<td>gyroX</td>
						<td>gyroY</td>
						<td>gyroZ</td>
						<td>magX</td>
						<td>magY</td>
						<td>magZ</td>
					</tr>
				</thead>

				<tbody>
					<?
					$time_list = array();
					$angle_list = array();
					$azimuth_list = array();
					$pitch_list = array();
					$roll_list = array();
					$accX_list = array();
					$accY_list = array();
					$accZ_list = array();
					$gyroX_list = array();
					$gyroY_list = array();
					$gyroZ_list = array();
					$magX_list = array();
					$magY_list = array();
					$magZ_list = array();

					$SQL = "SELECT * FROM rotation_vector WHERE performDateTime = '$pdt'";
					$query = mysql_query($SQL);
					$i = 1;
					while ($row = mysql_fetch_array($query)){
						$time_list[] = number_format( ($row['time']/1000), 1);
						$angle_list[] = $row['rawAngle'];
						$azimuth_list[] = $row['azimuth'];
						$pitch_list[] = $row['pitch'];
						$roll_list[] = $row['roll'];
						$accX_list[] = $row['accX'];
						$accY_list[] = $row['accY'];
						$accZ_list[] = $row['accZ'];
						$gyroX_list[] = $row['gyroX'];
						$gyroY_list[] = $row['gyroY'];
						$gyroZ_list[] = $row['gyroZ'];
						$magX_list[] = $row['magX'];
						$magY_list[] = $row['magY'];
						$magZ_list[] = $row['magZ'];
					?>
					<tr>
						<td><?=$i?></td>
						<td><?=number_format( ($row['time']/1000), 1)?></td>
						<td><?=$row['rawAngle']?></td>
						<td><?=$row['azimuth']?></td>
						<td><?=$row['pitch']?></td>
						<td><?=$row['roll']?></td>
						<td><?=$row['accX']?></td>
						<td><?=$row['accY']?></td>
						<td><?=$row['accZ']?></td>
						<td><?=$row['gyroX']?></td>
						<td><?=$row['gyroY']?></td>
						<td><?=$row['gyroZ']?></td>
						<td><?=$row['magX']?></td>
						<td><?=$row['magY']?></td>
						<td><?=$row['magZ']?></td>
					</tr>
					<? $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="../js/jquery.js"></script>
	<script src="../js/fusioncharts.js"></script>
	<script src="../js/fusioncharts.charts.js"></script>
	<script src="../js/themes/fusioncharts.theme.fint.js"></script>
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
				         	foreach ($time_list as $k => $time){
				         	?>
				            {
				               "label": "<?=$time?>"
				            }
				            <?
				            	if ($k != count($time_list) - 1)
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
				         	foreach ($angle_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				         "data": [
				         	<?
				         	foreach ($azimuth_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				         "data": [
				         	<?
				         	foreach ($pitch_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($roll_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($accX_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($accY_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($accZ_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($gyroX_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($gyroY_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($gyroZ_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($magX_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($magY_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
				            		echo ',';
				        	}
				        	?>
				         ]
				      },
				      {
				      	"data": [
				         	<?
				         	foreach ($magZ_list as $k => $angle){
				         	?>
				            {
				               "value": "<?=$angle?>"
				            }
				            <?
				            	if ($k != count($angle_list) - 1)
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