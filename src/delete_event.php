<?php
include "config.php";

// Retrieve the event ID from the query parameter
$eventId = $_GET['event_id'];

// Perform the deletion query
$query = "DELETE FROM event WHERE EventID = '$eventId'";
$result = mysqli_query($connection, $query);

// Check if the deletion was successful
if ($result) {
  // Deletion successful, return a success response
  http_response_code(200);
  echo "Event deleted successfully";
} else {
  // Deletion failed, return an error response
  http_response_code(500);
  echo "Failed to delete the event";
}
?>
