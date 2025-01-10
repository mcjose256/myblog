<?php 
session_start();
include 'db_connect.php'; // Include database connection

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'super_admin') {
    header("Location: login.php"); // Redirect to login page if not logged in or not an admin
    exit;
}

// Get the user_id from the URL (passed via GET)
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    //echo "User ID is: " . $user_id; // Debugging line
} else {
    echo "User ID not provided."; // This will help debug the issue
    exit;
}

// Fetch the current user details from the database
$sql = "SELECT id, username, email, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

// If the user exists, fetch the details
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $email, $role);
    $stmt->fetch();
} else {
    echo "User not found.";
    exit;
}

// Process the form submission to update the user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated values from the form
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_role = $_POST['role'];

    // Validate input
    if (empty($new_username) || empty($new_email) || empty($new_role)) {
        echo "All fields are required.";
    } else {
        // Update the user in the database
        $update_sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssi", $new_username, $new_email, $new_role, $user_id);

        if ($update_stmt->execute()) {
            echo "User updated successfully.";
        } else {
            echo "Error updating user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for color theme -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-control {
            border-color: #007bff;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h2>Edit User Details</h2>
            <!-- Show error or success messages -->
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message ?></div>
            <?php elseif (isset($success_message)): ?>
                <div class="alert alert-success"><?= $success_message ?></div>
            <?php endif; ?>

            <form method="POST" action="edit_user.php?id=<?php echo $user_id; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="super_admin" <?php echo ($role == 'super_admin') ? 'selected' : ''; ?>>Super Admin</option>
                        <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="sub_admin" <?php echo ($role == 'sub_admin') ? 'selected' : ''; ?>>Sub Admin</option>
                        <option value="user" <?php echo ($role == 'user') ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
