<?php
include 'db_connect.php'; // Include the database connection file
session_start(); // Start the session to check user login status

// Check if the user is logged in and if they have the required 'super_admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'super_admin') {
    // If not logged in or not an admin, redirect to the login page
    header('Location: login.php');
    exit();
}

// Fetch all posts from the database, ordered by the creation date (newest first)
$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($query); // Execute the query

// Fetch all users from the database for role management
$user_query = "SELECT * FROM users";
$user_result = $conn->query($user_query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the page */
        body {
            font-family: Arial, sans-serif;
        }

        /* Custom Colors */
        .sidebar {
            background-color: #ff3333;
            color: white;
        }

        .sidebar a {
            color: white;
        }

        .sidebar a:hover {
            background-color: #003366;
            color: white;
        }

        .btn-primary {
            background-color: #003366;
            border-color: #003366;
        }

        .btn-primary:hover {
            background-color: #001f33;
            border-color: #001f33;
        }

        .navbar {
            background-color: #003366;
        }

        .navbar a {
            color: white;
        }

        .navbar a:hover {
            color: #ff3333;
        }

        .post-title {
            color: #003366;
        }
    </style>
</head>

<body>

    <!-- Navbar: Navigation bar at the top -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <!-- Button to toggle the navbar on small screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar: Menu on the left side -->
            <div class="col-md-3 sidebar p-4">
                <h4>Admin Panel</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="add_post.php">Add New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_posts.php">Manage Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">Manage Users</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content (Manage Posts and Users) -->
            <div class="col-md-9">
                <h3>Manage Posts</h3>
                <!-- Button to add a new post -->
                <a href="add_post.php" class="btn btn-primary mb-3">Add New Post</a>
                <!-- Table to display the posts -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each post and display in table -->
                        <?php while ($post = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $post['id']; ?></td> <!-- Display post ID -->
                                <td class="post-title"><?= htmlspecialchars($post['title']); ?></td> <!-- Display post title -->
                                <td><?= $post['created_at']; ?></td> <!-- Display post creation date -->
                                <td>
                                    <!-- Links to edit and delete a post -->
                                    <a href="edit_post.php?id=<?= $post['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_post.php?id=<?= $post['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Manage Users Section -->
                <h3>Manage Users</h3>
                <!-- Table to display users -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each user and display in table -->
                        <?php while ($user = $user_result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $user['id']; ?></td> <!-- Display user ID -->
                                <td><?= htmlspecialchars($user['username']); ?></td> <!-- Display username -->
                                <td><?= htmlspecialchars($user['email']); ?></td> <!-- Display user email -->
                                <td><?= $user['role']; ?></td> <!-- Display user role -->
                                <td>
                                    <!-- Links to edit and delete a user -->
                                    <a href="edit_user.php?id=<?= $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_user.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS for interactive elements like dropdowns, modals, etc. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
