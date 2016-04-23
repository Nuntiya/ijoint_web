<? include('../include/stcnn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>iJoint - Task Creator</title>
	<meta charset="utf-8">
	<style>
	.btn{
		display: inline-block;
		padding: 10px;
		background: #3d718b;
		color: #FFF;
		cursor: pointer;
		border: 0;
		text-decoration: none;
		border-bottom: 2px solid #285c70;
		border-radius: 2px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		-webkit-transition: background 0.4s, border-color 0.4s;
		transition: background 0.4s, border-color 0.4s;
	}
	.btn:hover{ background: #4b9fc5; border-color: #4c91b0; }
	.row{ margin-bottom: 14px; }
	</style>
</head>
<body>
	<?
	$i = 1;
	$sql = "select * from patient order by pid asc";
	$query = mysql_query($sql);
	while ($row=mysql_fetch_array($query)){
	?>
	<div class="row">
		<?=$i?>. <?=$row['firstname'] . " " . $row['lastname']?> <a href="task_creating.php?pid=<?=$row['pid']?>" class="btn">Create a set of task</a>
	</div>
	<? $i++; } ?>
</body>
</html>