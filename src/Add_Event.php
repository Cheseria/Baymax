<?php
include 'config.php';
include 'calendar.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['EventName'])) {
        $EventName = $_POST['EventName'];
    }
    if(isset($_POST['EventDesc'])) {
        $EventDesc = $_POST['EventDesc'];
    }
    if (isset($_POST['EventDate'])) {
        $EventDate = $_POST['EventDate'];
    }
    if (isset($_POST['EventTime'])) {
        $EventTime = $_POST['EventTime'];
    }
    if(isset($_POST['CategoryName'])) {
        $CategoryName = $_POST['CategoryName'];
    }


    // Prepare the query to get the categoryId based on the category name
    $sql = "SELECT CategoryId FROM category WHERE CategoryName = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $CategoryName);
    $stmt->execute();

    // Bind the result variable to store the categoryId
    $stmt->bind_result($CategoryId);

    if($stmt->fetch()){
        $stmt->close();
        if(isset($_SESSION['UserID'])){
            $UserID = $_SESSION['UserID'];
            $sql1 = "INSERT INTO event (EventName, EventDescription, EventDate, EventTime, UserID, CategoryID) VALUES (?, ?, ?, ?, ?, ?);";
            $stmt1 = $connection->prepare($sql1);
            $stmt1->bind_param('ssssii', $EventName, $EventDesc, $EventDate, $EventTime, $UserID, $CategoryId);
            $stmt1->execute();
            $stmt1->close();

            echo '<script>window.location.href = "index.php";</script>';
        }else {
            // Handle the case where UserID is not set in the session
            echo "Error: UserID is not set in the session.";
        }
    } else {
        // Handle the case where the category does not exist
        echo "Error: Category not found.";
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
            <label> Date: "2023-05-27" </label>
            <input type="hidden" name="EventDate" value="2023-05-27">
            <label>Event Name:</label>'
            <input type="text" name="EventName">
            <label>Event Description:</label>
            <input type="text" name="EventDesc">
            <label>Time:</label>
            <input type="text" name="EventTime">
            <label>Category:</label>
            <input type="text" name="CategoryName">
            <input type="submit" value="Add Event">
        </form>
    </div>
</body>
</html>

