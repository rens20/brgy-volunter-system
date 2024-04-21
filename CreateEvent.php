<?php
require_once __DIR__ . '../config/configuration.php'; // Adjust the path to your configuration file

$message = ''; // Initialize an empty message variable

// Function to delete an event
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $event_id = $_GET['delete'];
    $delete_sql = "DELETE FROM events_table WHERE id = '$event_id'";
    if (mysqli_query($conn, $delete_sql)) {
        $message = "Event deleted successfully!";
    } else {
        $message = "Error deleting event: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_description = $_POST['event_description'];

    // Perform input validation here if needed

    // Insert event data into the events_table
    $sql = "INSERT INTO events_table (event_name, event_date, event_description) VALUES ('$event_name', '$event_date', '$event_description')";

    if (mysqli_query($conn, $sql)) {
        // $message = "Event created successfully!";s
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch events from the database
$fetch_sql = "SELECT id, event_name, event_date, event_description FROM events_table";
$result = mysqli_query($conn, $fetch_sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"], a.button {
            background-color: #581c87;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        button[type="submit"]:hover, a.button:hover {
            background-color: #3b0764;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .delete-link {
            color: red;
            margin-left: 10px;
        }
        .event-list {
    margin-top: 20px;
}

.event-list h2 {
    color: #333;
    margin-bottom: 10px;
}

.event-item {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.event-info {
    flex-grow: 1;
}

.delete-link {
    color: red;
    cursor: pointer;
}

    </style>
</head>

<body>
     <div class="flex h-screen">
        <div class="bg-purple-900 text-white w-64 py-4 px-8">
            <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
            <ul class="mt-6">
                <li><a href="#" class="block py-6">Dashboard</a></li>
                <li><a href="CreateEvent.php" class="block py-6">Events</a></li>
                <li><a href="info.php" class="block py-6">Registrations</a></li>
                <li><a href="#" class="block py-6">Reports</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="w-full px-8 py-8">
            <!-- Header -->
            <div class="bg-purple-900 text-white py-4 px-8 mb-8 flex justify-between items-center">
           
           <h1 class="text-3xl font-bold text-white">Event Management</h1>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-white hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-200">Logout</a>
                </div>
            </div>
    <div class="container">


        <div>
   

            <!-- Event Creation Form -->
            <form id="eventForm" method="POST" action="">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" placeholder="Event Name" required><br>

                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date"  placeholder="Event Date"  required><br>

                <label for="event_description">Event Description:</label><br>
                <textarea id="event_description" name="event_description"  placeholder="Event description"   rows="4" required></textarea><br>

                <button type="submit">Create Event</button>
            </form>
        </div>

        <!-- Event List -->
       <!-- Event List -->
<div class="event-list">
    <h2>Events List</h2>
    <ul>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li class='event-item'>";
                echo "<span class='event-info'>{$row['event_name']} - {$row['event_date']}</span>";
                echo "<a class='delete-link' href='?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this event?\")'>Delete</a>";
                echo "</li>";
            }
        } else {
            // echo "<li>No events found</li>";
        }
        ?>
    </ul>
</div>

    </div>
</body>

</html>
