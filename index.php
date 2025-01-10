<?php
include 'db_connect.php'; // Include database connection

// Fetch all posts from the database
$stmt = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Your custom styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #0044cc; /* Blue */
        }
        .navbar-brand {
            color: white;
            font-size: 1.5rem;
        }
        .navbar-brand:hover {
            color: #ff0000; /* Red */
        }
        .btn-primary {
            background-color: #ff0000; /* Red */
            border-color: #ff0000;
        }
        .btn-primary:hover {
            background-color: #0044cc; /* Blue */
            border-color: #0044cc;
        }
        footer {
            background-color: #0044cc; /* Blue */
        }
        footer a {
            color: white;
        }
        footer a:hover {
            color: #ff0000; /* Red */
        }
        #scrollTopBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            background-color: #0044cc; /* Blue */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }
        #scrollTopBtn:hover {
            background-color: #ff0000; /* Red */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'includes/nav.php'; ?>

    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="text-center">Welcome to My Blog</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container mt-4">
            <?php if (!empty($posts)): ?>
                <div class="row">
                    <?php foreach ($posts as $post): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <?php if (!empty($post['thumbnail'])): ?>
                                    <img src="<?php echo htmlspecialchars($post['thumbnail']); ?>" class="card-img-top" alt="Thumbnail">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($post['excerpt'])); ?></p>
                                    <a href="readmore.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                                <div class="card-footer text-muted">
                                    Posted on <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">No posts available.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Feedback Section -->
    <section id="feedback" class="bg-light py-4">
        <div class="container">
            <h2 class="text-center mb-4">Give Us Your Feedback</h2>
            <form action="feedback.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" onclick="scrollToTop()">↑</button>

    <!-- JavaScript -->
    <script>
        const scrollTopBtn = document.getElementById("scrollTopBtn");

        // Show button when user scrolls down
        window.onscroll = () => {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollTopBtn.style.display = "block";
            } else {
                scrollTopBtn.style.display = "none";
            }
        };

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
