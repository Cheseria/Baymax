<?php
include "config.php";
session_start();
$UserID = $_SESSION['UserID'];
// Retrieve the selected date from the query parameter
$selectedDate = $_GET['selected_date'];

// Connect to the database and execute the query to fetch events for the selected date
$query = "SELECT * FROM event WHERE EventDate = '$selectedDate' AND UserID = '$UserID'";
$result = mysqli_query($connection, $query);


$html = ''; // Initialize the $html variable

// Check if there are any events
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $eventDate = $row['EventDate'];
      $eventName = $row['EventName'];
      $categoryId = $row['CategoryID'];
      $eventDescription = $row['EventDescription'];
      $eventTime = $row['EventTime'];
      $eventDate = $row['EventDate'];
      $eventId = $row['EventID'];

      $html .= $eventDate;
      $html .= '<div class="eventElement">';
      $html .= '<div class="eventHeader">';
      $html .= " $eventName ";
      $html .= '<div class="dots category-' . $categoryId . '"> </div>';
      $html .= '</div>';
      $html .= '<div class="event-description-container">';
      $html .= '<div class="element">Date: ' . $eventDate . '</div>';
      $html .= '<div class="element">Time: ' . $eventTime . '</div>';
      $html .= '<div class="element">Desc: ' . $eventDescription . '</div>';
      $html .= '<button class="delete-button" data-event-id="' . $eventId . '">Delete</button>'; // Add the delete button
      $html .= '</div>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '</div>';
    }
  } else {
    $html .= $selectedDate;
    $html .= '<p>No Events</p>';

  }
// Return the HTML response
echo $html;
?>
