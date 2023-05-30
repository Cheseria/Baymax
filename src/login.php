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

        $sql = "SELECT * FROM User WHERE username='$username' AND password='$password';";
        $result = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($result);

    // Check if the username already exists
    if ($rows==1) {
        $_SESSION['username'] = $username;

        $row = mysqli_fetch_assoc($result);
    
        // Retrieve the userID value
        $UserID = $row['UserID'];
        $_SESSION['UserID'] = $UserID;
        
        header('Location: index.php');
        exit;
    } else {
        // Register the user
        echo "Username or Password invalid! Register if you haven't already";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
</head>
<body>
    
    <h3>Welcome to Baymax calendar</h3>
    <div class="login-form">
        <h2 class="login-heading">Login</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" requi>            <input type="password" name="password" placeholder="Password" r>            <input type="submit" value="Login">
        </form>
        <a href="register.php" class="register-link">Register</a>
    </div>
</body>
</html>

