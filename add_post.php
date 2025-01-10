<?php
include 'db_connect.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Style.css"> <!-- Your custom styles (if any) -->
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="text-center">Add New Post</h1>
        </div>
    </header>

    <main>
        <div class="container mt-4">
            <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
            <form action="validate_post.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="excerpt" class="form-label">Excerpt:</label>
                    <textarea id="excerpt" name="excerpt" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail Image (optional):</label>
                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="image1" class="form-label">Additional Image 1 (optional):</label>
                    <input type="file" id="image1" name="image1" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="image2" class="form-label">Additional Image 2 (optional):</label>
                    <input type="file" id="image2" name="image2" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Add Post</button>
            </form>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
