<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joined Events</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Joined Events</h1>
        <div class="bg-white p-4 border border-gray-300 rounded-md shadow-md">
            <?php
            // Read the contents of joined_events.txt if it exists
            $filename = 'joined_events.txt';
            if (file_exists($filename)) {
                $joinedEvents = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                if (!empty($joinedEvents)) {
                    echo "<ul class='list-disc pl-8'>";
                    foreach ($joinedEvents as $eventId) {
                        echo "<li>Event ID: $eventId</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No events joined yet.</p>";
                }
            } else {
                echo "<p>No events joined yet.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
