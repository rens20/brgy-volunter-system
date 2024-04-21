<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Events</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-purple-900 text-white py-4 px-8 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold">Barangay Events</h1>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </a>
                <a href="#" class="text-white hover:text-gray-200">User Account</a>
            </div>
        </div>

        <!-- Event Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            // Include your database configuration file and connect to the database
            require_once 'config/configuration.php';

            // Fetch events from the database
            $sql = "SELECT * FROM events_table";
            $result = mysqli_query($conn, $sql);

            // Check if there are events to display
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='bg-white p-4 border border-gray-300 rounded-md shadow-md'>";
                    echo "<h2 class='text-lg font-bold mb-2'>event" . $row['event_name'] . "</h2>";
                    echo "<p class='text-gray-600 mb-2'>Date: " . $row['event_date'] . "</p>";
                    echo "<p class='text-gray-600'>Discription: " . $row['event_description'] . "</p>";
                    // Add data attributes for event ID and current join count
                    echo "<button class='join-button mt-4 bg-purple-900 text-white px-4 py-2 rounded hover:bg-purple-950 w-full' data-event-id='" . $row['id'] . "' data-current-joins='0'>Join</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No events found.</p>";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Include jQuery for JavaScript functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.join-button').click(function() {
                var button = $(this);
                var eventId = button.data('event-id');
                var currentJoins = parseInt(button.data('current-joins'));

                // Check if the user hasn't joined yet (optional)
                if (!button.hasClass('joined')) {
                    $.ajax({
                        type: 'POST',
                        url: 'join_event.php',
                        data: { event_id: eventId },
                        success: function(response) {
                            if (response === 'success') {
                                // Update button text and style
                                button.text('Joined').addClass('joined');
                                currentJoins++;
                                button.data('current-joins', currentJoins);
                            } else {
                                alert('Failed to join event.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    alert('You have already joined this event.');
                }
            });
        });
    </script>
</body>

</html>
