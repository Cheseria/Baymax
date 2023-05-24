<?php
include 'config.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
	if (isset($_POST['username'])) {
		$username = $_POST['username'];
    	}
    	if(isset($_POST['password'])) {
    		$password = $_POST['password'];
    	}
    	if ($username == '' || $password == ''){
        	die('Name or Pass should not be empty');
    	}

    	$sql = "SELECT * FROM User WHERE UserName='$username';";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);

    // Check if the username already exists
    if ($row && $row['UserName'] == $username) {
        echo 'Username already exists. Please choose a different username.';
    } else {
        // Register the user
        $sql1 = "INSERT INTO User (UserName, Password) VALUES (?,?);";

	$stmt = $connection->prepare($sql1);
	$stmt->bind_param('ss', $username, $password);

	$result = $stmt->execute();

	if ($result) {
    		$lastInsertedId = $connection->insert_id;
    		echo "Registration Successful.";
	        header('Refresh: 2; URL=login.php');
	        exit;
	} else {
    		echo "Error register user.";
	}
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register-heading {
            margin-bottom: 10px;
        }

        .input-field {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register-form">
        <h2 class="register-heading">Register</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" required class="input-field"><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required class="input-field"><br>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>

