<?php

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: src/login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header('Location: src/login.php'); // Redirect to login page
    exit;
}

include 'calendar.php';
$currentdate =  date('Y-m-d');
$calendar = new Calendar($currentdate);
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="src/css/style.css" rel="stylesheet" type="text/css">
		<link href="src/css/calendar.css" rel="stylesheet" type="text/css">
		
		
	</head>
	<body> 
        <div class='head'>
            <h1>Welcome, <?php echo $_SESSION['username'];?>!</h1>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="logout" value="Logout">
        </div>
		<div class="content home">	
			<?=$calendar?>
		</div>

		
		<script src="src/script.js"></script>
	</body>
	
	
</html>
