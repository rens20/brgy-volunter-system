<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Volunter System</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <header class="bg-purple-900 text-white py-4 flex justify-between items-center">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold">Barangay Volunter System</h1>
        </div>
        <div class="mr-4">
            <a href="login.php" class="bg-white text-purple-900 font-bold py-2 px-4 rounded">Login</a>
        </div>
    </header>


    <div class="container mx-auto  my-40">
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-xl font-bold mb-4">Welcome to the Barangay Volunteer System</h2>
            <p class="text-gray-700">
                This system is designed to manage barangay volunteers effectively. Volunteers play a crucial role in
                community development and we aim to streamline the process of volunteer registration, task assignment,
                and tracking.
            </p>
            <p class="text-gray-700 mt-4">
                If you are a new volunteer, you can register by clicking the button below.
            </p>
            <a href="register.php"
                class="bg-purple-900 hover:bg-purple-950 text-white font-bold py-2 px-4 mt-4 inline-block rounded">Register
                Now</a>
        </div>
    </div>
</body>

</html>