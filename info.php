<?php
$profiles_folder = 'profiles/';

// Check if the profiles folder exists
if (is_dir($profiles_folder)) {
    // Get all JSON files in the profiles folder
    $profile_files = glob($profiles_folder . '*.json');

    if (!empty($profile_files)) {
        // Initialize an array to store profiles by month
        $profiles_by_month = [];

        foreach ($profile_files as $file) {
            // Read JSON data from each file
            $profile_json = file_get_contents($file);
            $profile_data = json_decode($profile_json, true);

            // Get the creation month of the profile
            $creation_month = date('F Y', filemtime($file));

            // Check if the month key exists in the array, if not, initialize it
            if (!array_key_exists($creation_month, $profiles_by_month)) {
                $profiles_by_month[$creation_month] = [];
            }

            // Add the profile data to the corresponding month
            $profiles_by_month[$creation_month][] = $profile_data;
        }

     // Search functionality
        $search_query = isset($_GET['search']) ? $_GET['search'] : '';
        $filtered_profiles = [];

        if (!empty($search_query)) {
            foreach ($profiles_by_month as $month_profiles) {
                foreach ($month_profiles as $profile) {
                    if (stripos($profile['profile_name'], $search_query) !== false) {
                        $filtered_profiles[] = $profile;
                    }
                }
            }

            // Reorder the filtered profiles based on search query match
            usort($filtered_profiles, function($a, $b) use ($search_query) {
                $a_match = stripos($a['profile_name'], $search_query) !== false;
                $b_match = stripos($b['profile_name'], $search_query) !== false;

                if ($a_match && !$b_match) {
                    return -1;
                } elseif (!$a_match && $b_match) {
                    return 1;
                } else {
                    return 0;
                }
            });
        } else {
            // If no search query, display all profiles
            $filtered_profiles = $profile_files;
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profile Information</title>
            <!-- Include Tailwind CSS -->
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="bg-gray-100">
            <div class="flex h-screen">
        <div class="bg-purple-900 text-white w-64 py-4 px-8">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <ul class="mt-6">
                <li><a href="#" class="block py-2">Dashboard</a></li>
                <li><a href="CreateEvent.php" class="block py-2">Events</a></li>
                <li><a href="info.php" class="block py-2">Registrations</a></li>
                <li><a href="#" class="block py-2">Reports</a></li>
            </ul>
        </div>
        <!-- Content -->
        <div class="w-full px-8 py-8">
            <!-- Header -->
            <div class="bg-purple-900 text-white py-4 px-8 mb-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold">Profile Information</h1>
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
            <div class="container mx-auto py-8">
                <form action="" method="GET" class="mb-4">
                    <input type="text" name="search" placeholder="Search by name..." value="<?php echo htmlspecialchars($search_query); ?>" class="px-4 py-2 rounded-lg border-gray-300 border focus:outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded focus:outline-none focus:shadow-outline">Search</button>
                </form>
   <!-- #region --> 

                 <?php
                
                // Loop through the profiles grouped by month
                foreach ($profiles_by_month as $month => $profiles) {
                    ?>
                    <div class="mb-6">
                        <h2 class="text-xl font-bold mb-2"><?php echo $month; ?></h2>
                        <ul>
                            <?php foreach ($profiles as $profile) { ?>
                                <li class="bg-white shadow-md rounded px-8 py-6 mb-4">
                                    <p class="block text-lg font-bold mb-2">Name: <?php echo $profile['profile_name']; ?></p>
                                    <p class="text-gray-700">Email: <?php echo $profile['email']; ?></p>
                                    <p class="text-gray-700">Contact: <?php echo $profile['contact']; ?></p>
                                    <?php if (!empty($profile['image'])) : ?>
                                        <img src="uploads/<?php echo $profile['image']; ?>" alt="Profile Image" class="mt-2 rounded-lg h-32 w-auto">
                                    <?php endif; ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "No profiles found.";
    }
} else {
    echo "Profiles folder not found.";
}
?>
