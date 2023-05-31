<?php
include "config.php";
// Retrieve the selected date from the query parameter
$selectedDate = $_GET['selected_date'];

// Connect to the database and execute the query to fetch events for the selected date
$query = "SELECT * FROM event WHERE EventDate = '$selectedDate'";
$result = mysqli_query($connection, $query);


$html = ''; // Initialize the $html variable

// Check if there are any events
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $eventName = $row['EventName'];
      $categoryId = $row['CategoryID'];
      $html .= '<div class="element">';
      $html .= " $eventName ";
      $html .= '<div class="dots category-' . $categoryId . '">';
      $html .= '</div>';
      $html .= '</div>';
    }
  } else {
    $html .= '<p>No Events</p>';
  }
// Return the HTML response
echo $html;
?>
