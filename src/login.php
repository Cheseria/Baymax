<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if it's the first time for the user
    if (!isset($_SESSION['registeredUsers'])) {
        // Initialize the registered users array
        $_SESSION['registeredUsers'] = [];
    }

    // Retrieve the registered users from the session
    $registeredUsers = $_SESSION['registeredUsers'];

    // Check if the username already exists
    if (isset($registeredUsers[$username])) {
        header('Location: main.php');
    } else {
        // Register the user
        $registeredUsers[$username] = $password;
        $_SESSION['registeredUsers'] = $registeredUsers;

        // Redirect to the login page
        header('Location: login.php');
        exit;
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

