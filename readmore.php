<?php
include 'db_connect.php'; // Include database connection

// Get the post ID from the URL parameter
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Fetch the post from the database
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();

    // Check if post exists
    if (!$post) {
        echo "Post not found.";
        exit;
    }

    // Handle new comment submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_text'])) {
        $commentText = $_POST['comment_text'];
        $userId = 1; // Replace with the logged-in user's ID

        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $postId, $userId, $commentText);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Comment added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding comment: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    // Fetch comments for the post
    $stmt = $conn->prepare("SELECT c.comment_text, c.created_at, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = ? ORDER BY c.created_at DESC");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $comments = $stmt->get_result();
    $stmt->close();
} else {
    echo "Invalid post ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Style.css"> <!-- Your custom styles (if any) -->
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="text-center"><?php echo htmlspecialchars($post['title']); ?></h1>
        </div>
    </header>

    <main>
        <div class="container mt-4">
            <!-- Display Thumbnail -->
            <?php if (!empty($post['thumbnail'])): ?>
                <div class="text-center mb-4">
                    <img src="<?php echo htmlspecialchars($post['thumbnail']); ?>" class="img-fluid" alt="Thumbnail">
                </div>
            <?php endif; ?>

            <!-- Display Excerpt -->
            <div class="mb-4">
                <p><strong>Excerpt:</strong> <?php echo nl2br(htmlspecialchars($post['excerpt'])); ?></p>
            </div>

            <!-- Display Content -->
            <div class="mb-4">
                <p><strong>Content:</strong> <?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            </div>

            <!-- Display Additional Images (if available) -->
            <div class="row">
                <?php if (!empty($post['image1'])): ?>
                    <div class="col-md-6 mb-4">
                        <img src="<?php echo htmlspecialchars($post['image1']); ?>" class="img-fluid" alt="Image 1">
                    </div>
                <?php endif; ?>
                <?php if (!empty($post['image2'])): ?>
                    <div class="col-md-6 mb-4">
                        <img src="<?php echo htmlspecialchars($post['image2']); ?>" class="img-fluid" alt="Image 2">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Comment Section -->
            <div class="mt-5">
                <h3>Comments</h3>
                <?php while ($comment = $comments->fetch_assoc()): ?>
                    <div class="mb-3">
                        <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                        <small class="text-muted"><?php echo htmlspecialchars($comment['created_at']); ?></small>
                        <p><?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?></p>
                    </div>
                <?php endwhile; ?>

                <h4>Add a Comment</h4>
                <form method="POST">
                    <div class="mb-3">
                        <textarea name="comment_text" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
