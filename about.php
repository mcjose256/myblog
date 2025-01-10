<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - My Blog</title>
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

        footer {
            background-color: #0044cc; /* Blue */
        }

        footer a {
            color: white;
        }

        footer a:hover {
            color: #ff0000; /* Red */
        }

        .about-section {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .about-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-title {
            color: #0044cc;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .about-text {
            font-size: 1.2rem;
            color: #333;
            line-height: 1.6;
        }

        .contribute-btn {
            background-color: #ff0000;
            border-color: #ff0000;
            color: white;
            padding: 10px 20px;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        .contribute-btn:hover {
            background-color: #0044cc;
            border-color: #0044cc;
        }

        .footer-links a {
            color: white;
            margin: 0 10px;
        }

        .footer-links a:hover {
            color: #ff0000;
        }

        .profile-img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .profile-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" height="40" class="me-2"> My Blog
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="admn_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <section class="about-section">
        <div class="container about-content">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="your-profile-picture.jpg" alt="Joseph Akandwanaho" class="profile-img"> <!-- Add your profile picture here -->
                <h2 class="about-title">About Me</h2>
            </div>
            <p class="about-text">Hello! My name is Joseph Akandwanaho, and I am the creator of this blog. I started this blog to share my insights, experiences, and knowledge on various topics that interest me. My goal is to create a platform where readers can engage with quality content, exchange ideas, and be inspired to learn more about technology, health, education, and many other subjects.</p>
            <p class="about-text">I have a deep passion for technology and its potential to impact the world positively. I am currently a student at Mbarara University of Science and Technology (MUST) and I am working on various projects in the fields of computer science and AI. This blog allows me to share my work, collaborate with others, and build a community of like-minded individuals.</p>

            <h3 class="about-title">How You Can Contribute</h3>
            <p class="about-text">I believe in the power of community, and I welcome contributions from readers and aspiring bloggers. If you're passionate about a subject and want to share your knowledge, here's how you can contribute:</p>
            <ul class="about-text">
                <li>Write guest posts on topics related to technology, education, health, or any area that interests you.</li>
                <li>Share your insights by leaving thoughtful comments on posts, engaging with the content, and helping to build discussions.</li>
                <li>If you have ideas for new blog topics, feel free to reach out to me via the contact form or by email.</li>
                <li>Follow and share my content with your friends and networks to help spread the word.</li>
            </ul>

            <a href="register.php" class="btn contribute-btn">Contribute Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            <p>&copy; <?php echo date('Y'); ?> My Blog. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="https://facebook.com" target="_blank">Facebook</a> | 
                <a href="https://twitter.com" target="_blank">Twitter</a> | 
                <a href="https://instagram.com" target="_blank">Instagram</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
