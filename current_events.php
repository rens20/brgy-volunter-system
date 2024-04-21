<?php
// Assuming you have your database connection established
require_once __DIR__ . '../config/configuration.php'; // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Query the database to get event details based on $event_id
    $event_sql = "SELECT * FROM events_table WHERE id = '$event_id'";
    $event_result = mysqli_query($conn, $event_sql);

    if ($event_result && mysqli_num_rows($event_result) > 0) {
        $event = mysqli_fetch_assoc($event_result);
        // Display event details here
        echo "<h1>{$event['event_name']}</h1>";
        echo "<p>Date: {$event['event_date']}</p>";
        echo "<p>Description: {$event['event_description']}</p>";
    } else {
        echo "Event not found";
    }
} else {
    echo "Invalid request";
}
