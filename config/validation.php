<?php

function ValidateLogin($username, $password){
     
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    $sql = "SELECT * FROM users WHERE username = '$username' && password = '$password'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    return $row;
    
}


function Register($username, $password){
    

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 


        $insert = "INSERT INTO users (username, password, type) VALUES ('$username', '$password', 'user')";

        if ($conn->query($insert) === TRUE) {
            
            $report = 'Registered Complete!';
            header("location: profile.php");

        }else{

            $report = 'Error Database!';
        }


    

    return $report;




}
function createProfile($user_id, $profile_name, $email, $contact, $image) {
    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check if the connection is successful
    if (!$conn) {
        return 'Error connecting to the database';
    }

    // Prepare the SQL statement to insert data into the profiles table
    $sql = "INSERT INTO profiles (user_id, profile_name, email, contact, image) VALUES (?, ?, ?, ?, ?)";
    
    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the prepared statement was created successfully
    if (!$stmt) {
        return 'Error preparing SQL statement';
    }

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, 'issss', $user_id, $profile_name, $email, $contact, $image);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Profile creation successful
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return 'Profile created successfully';
    } else {
        // Error in executing the prepared statement
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return 'Error creating profile';
    }
}
