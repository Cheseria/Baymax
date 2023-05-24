<?php
include 'config.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
	if(isset($_POST['username'])){
		$username = $_POST['username'];
    	}
    	if(isset($_POST['password'])){
	    	$password = $_POST['password'];
    	}

	$sql = "SELECT * FROM User WHERE UserName='$username' AND Password='$password';";
        $result = mysqli_query($connection, $sql);
	$rows = mysqli_num_rows($result);


    // Check if the username already exists
    if ($rows==1) {
        header('Location: main.php');
    } else {
        // Register the user
        echo "Username or Password invalid! Register if you haven't already";

        // Redirect to the login page
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-heading {
            margin-bottom: 10px;
        }

        .input-field {
            margin-bottom: 10px;
        }
        
        .register-link {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2 class="login-heading">Login</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" required class="input-field"><br>
            <input type="password" name="password" placeholder="Password" required class="input-field"><br>
            <input type="submit" value="Login">
        </form>
        <a href="register.php" class="register-link">Register</a>
    </div>
</body>
</html>

