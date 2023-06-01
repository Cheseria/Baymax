<?php
include "config.php";

// Retrieve the event ID from the query parameter
$categoryId = $_GET['category_id'];

// Perform the deletion query
$query = "DELETE FROM category WHERE CategoryID = '$categoryId'";
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
