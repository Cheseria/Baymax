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
        echo 'Username already exists. Please choose a different username.';
    } else {
        // Register the user
        $registeredUsers[$username] = $password;
        $_SESSION['registeredUsers'] = $registeredUsers;

        // Display registration successful message
        echo 'Registration successful.';

        // Redirect back to the login page
        header('Refresh: 2; URL=login.php');
        exit;
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

