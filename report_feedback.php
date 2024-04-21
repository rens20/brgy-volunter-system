<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-semibold mb-6">Feedback Messages</h1>
            <?php
            // Database configuration
            require_once __DIR__ . '../config/configuration.php';
            require_once __DIR__ . '../config/validation.php';
          
            // Check if a delete request is made
            if (isset($_POST['delete_id'])) {
                $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
                $sql_delete = "DELETE FROM feedback_messages WHERE id = '$delete_id'";
                if (mysqli_query($conn, $sql_delete)) {
                    
                } else {
                    echo "<div class='bg-red-200 text-red-800 p-2 mb-2'>Error deleting message: " . mysqli_error($conn) . "</div>";
                }
            }

            // Fetch messages from the database
            $sql_select = "SELECT * FROM feedback_messages ORDER BY created_at DESC";
            $result = mysqli_query($conn, $sql_select);

            // Display messages
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="bg-gray-200 rounded-lg p-4 mb-4 shadow-md flex justify-between items-center">
                        <div>
                            <p class="text-gray-800"><strong>Message:</strong> <?= $row['message'] ?></p>
                            <p class="text-gray-600"><strong>Date:</strong> <?= $row['created_at'] ?></p>
                        </div>
                        <form method="POST" action="">
                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none">
                                Delete
                            </button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center text-gray-500'>No feedback messages.</p>";
            }

            // Close connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
