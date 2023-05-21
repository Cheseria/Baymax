<?php
include 'Calendar.php';
$currentdate =  date('Y-m-d');
$calendar = new Calendar($currentdate);
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
			<div class="content home">	
			<?=$calendar?>
		</div>
	</body>
</html>
