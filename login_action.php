<?php
session_start(); // Start session

include 'db_connect.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form input values
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input fields
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty_fields");
        exit;
    }

    // Prepare SQL query to get the user from the database
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        // Bind result to variables
        $stmt->bind_result($user_id, $db_username, $db_password, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $db_password)) {
            // Set session variables to store user information
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;

            // Redirect to homepage or dashboard
            header("Location: index.php");
            exit;
        } else {
            // Invalid password
            header("Location: login.php?error=invalid_password");
            exit;
        }
    } else {
        // User not found
        header("Location: login.php?error=user_not_found");
        exit;
    }
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: login.php");
    exit;
}
?>
