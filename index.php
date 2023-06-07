<?php
include "src/config.php";

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: src/login.php');
    exit();
}

include 'src/calendar.php';
$currentdate =  date('Y-m-d');
$calendar = new Calendar($currentdate);

$UserID = $_SESSION['UserID'];
$sql = "SELECT * FROM event WHERE UserID = $UserID";
$sqlc = "SELECT * FROM category WHERE UserID = $UserID";

$result =  $connection->query($sql);
$resultc =  $connection->query($sqlc);
$rows = mysqli_num_rows($result);
$rowsc = mysqli_num_rows($resultc);

if ($rows > 0) {
	// Loop through the rows and add the events to the calendar
	while ($row = $result->fetch_assoc()) {
		$EventName = $row['EventName'];
		$EventDate = $row['EventDate'];
		$CategoryID = $row['CategoryID'];

		// Add the event to the calendar
		$calendar->add_event($EventName, $EventDate, 1, $CategoryID);
	}
}
if ($rowsc > 0) {
	// Loop through the rows and add the categories to the calendar
	while ($row = $result->fetch_assoc()) {
		$CategoryName = $row['CategoryName'];
		$CategoryID = $row['CategoryID'];

		// Add the event to the calendar
		$calendar->add_category($CategoryName, $CategoryID);
	}
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="src/css/dynamic_styles.css" rel="stylesheet" type="text/css">
		<link href="src/css/style.css" rel="stylesheet" type="text/css">
		<link href="src/css/calendar.css" rel="stylesheet" type="text/css">
		
		
	</head>
	<body> 
        <div class='navtop'>
            <h1>Welcome, <?php echo $_SESSION['username'];?>!</h1>

			<button onclick="window.location.href = 'src/logout.php';" style="margin-left:10px">Logout</button>
        </div>
		
		<div class="content home">	
			<div><?=$calendar?></div>
		</div>

		<script src="src/script.js"></script>
	</body>
	
	
</html>
