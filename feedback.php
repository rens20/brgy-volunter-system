<?php

require_once __DIR__ . '../config/configuration.php';
require_once __DIR__ . '../config/validation.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 

    // Escape user inputs to prevent SQL injection
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert message into database
    $sql = "INSERT INTO feedback_messages (message) VALUES ('$message')";
    if (mysqli_query($conn, $sql)) {
       
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Barangay Volunteer System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-purple-900">
    <div class="container mx-auto px-8 mt-40">
        <div class="bg-white p-6 rounded shadow max-w-md mx-auto">
            <h2 class="text-xl font-bold mb-4">Feedback</h2>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="message" class="block text-gray-700">Your Message:</label>
                    <textarea id="message" name="message" rows="4"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full py-2 px-3 border border-gray-300 rounded-md bg-white text-gray-700 shadow-sm sm:text-sm"></textarea>
                </div>
                <button type="submit"
                    class="bg-purple-900 hover:bg-purple-950 text-white font-bold py-2 px-4 mt-4 rounded inline-block">Send
                    Feedback</button>
            </form>
        </div>
    </div>
</body>
</html>

