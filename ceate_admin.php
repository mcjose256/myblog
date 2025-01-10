<?php
include 'db_connect.php'; // Include the database connection file

// Define the super admin's details
$username = 'passy';
$password = '123'; // Plain-text password
$email = 'jose@gmail.com';
$role = 'super_admin';

// Hash the password using PHP's password_hash function
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert the super admin into the users table
$sql = "INSERT INTO users (username, password, email, role, created_at)
        VALUES ('$username', '$hashed_password', '$email', '$role', NOW())";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Super admin created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
