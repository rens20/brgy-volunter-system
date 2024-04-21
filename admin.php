   <?php
    // Include the configuration file
    require_once __DIR__ . '/config/configuration.php';

    // Function to count registered users
    function countUsers() {
        // Use the defined constants from configuration.php
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check if connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $countQuery = "SELECT COUNT(*) as total_users FROM users";
        $result = mysqli_query($conn, $countQuery);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['total_users'];
        } else {
            return "Error counting users";
        }
    }
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Barangay Events</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="bg-purple-900 text-white w-64 py-4 px-8">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
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
                <h1 class="text-3xl font-bold">Admin Dashboard</h1>
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

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
            <h2 class="text-xl font-bold mb-4">Registered Users Count</h2>
            <div class="flex items-center mb-4">
                <!-- User icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-gray-700">Total registered users:</span>
                <!-- Display total user count using PHP -->
                <span class="text-purple-700 font-bold ml-2"><?php echo countUsers(); ?></span>
            </div> 
            </div>
        </div>
    </div>

    <script>
  

        // Prevent default behavior of Events link
        const eventsLink = document.querySelector('a[href="#"]');
        eventsLink.addEventListener('click', function(event) {
            event.preventDefault(); 
           
        });
    </script>
</body>

</html>