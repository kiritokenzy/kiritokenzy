<?php

// Connect to the database


$conn = mysqli_connect("localhost", "hkouadwz_root", "12345678", "hkouadwz_root");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the user input
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Check if the username is already taken
$sql = "SELECT * FROM accounts WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // username already exists
    echo "Username already taken. Please choose a different username.";
}else {
    
        // username is available, insert the new account into the database
        $sql = "INSERT INTO accounts (username, password, ban, havechar, isOn, active, balance)
        VALUES ('$username', '$password', 0, 1, 0, 1, 1)";
    
        if (mysqli_query($conn, $sql)) {
            // Account created successfully
            echo "Account created successfully";
            
            // Redirect to homepage
            header("Location: index.html");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }