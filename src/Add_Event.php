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