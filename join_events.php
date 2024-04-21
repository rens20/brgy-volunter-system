<?php
// Include your database configuration file and connect to the database
require_once 'config/configuration.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];

    // Increment join count in the database
    $sql = "UPDATE events_table SET joins = joins + 1 WHERE id = $eventId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid request';
}

// Close database connection
mysqli_close($conn);
?>
