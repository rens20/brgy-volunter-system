<?php

require_once __DIR__ . '../config/configuration.php';
require_once __DIR__ . '../config/validation.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty(ValidateLogin($username, $password))){
            
            echo "Login Failed";

        }else{
        
        
        session_start();   
        $validate = ValidateLogin($username, $password)['type'];



        if($validate == 'admin'){

            $_SESSION['token'] = $validate;
            header("Location: admin.php");
            exit();

        }elseif($validate == 'user'){

            $_SESSION['token'] = $validate;
            header("Location: events.php");
            exit();

        }

        }

    }



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
   <div class="container mx-auto px-8 mt-40">
        <div class="bg-white p-6 rounded shadow max-w-md mx-auto">
            <h2 class="text-xl font-bold mb-4">Register</h2>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username:</label>
                    <input type="text" id="username" name="username"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full py-2 px-3 border border-gray-300 rounded-md bg-white text-gray-700 shadow-sm sm:text-sm">
                </div>
      <div class="mb-4 relative">
    <label for="password" class="block text-gray-700">Password:</label>
    <div class="relative">
        <input type="password" id="password" name="password" class="mt-1 focus:ring-indigo-500 block w-full py-2 px-3 border border-gray-300 rounded-md bg-white text-gray-700 shadow-sm sm:text-sm pr-10">
        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center justify-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
            <i class="far fa-eye text-purple-900"></i>
        </button>
    </div>
</div>
                <button type="submit"
                    class="bg-purple-900 hover:bg-purple-950 text-white font-bold py-2 px-4 mt-4 rounded inline-block">Register</button>
            </form>
        </div>
    </div>
    <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
