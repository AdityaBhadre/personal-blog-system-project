<?php
require("../auth/auth_check.php");
require("../config/db.php");

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$blog_id = $_GET['id'];

// Fetch blog post
$stmt = $conn->prepare("SELECT blogs.*, users.name FROM blogs JOIN users ON blogs.user_id = users.id WHERE blogs.id = ?");
$stmt->execute([$blog_id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);
 
if (!$blog) {
    echo "Blog post not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($blog['title']) ?> | Blog</title>
    <link rel="stylesheet" href="../assets/css/view.css">
</head>
<body>

    <div class="container">
        <h1><?= htmlspecialchars($blog['title']) ?></h1>
        <p class="author">by <?= htmlspecialchars($blog['name']) ?> | <?= date("F j, Y", strtotime($blog['created_at'])) ?></p>
        
        <?php if (!empty($blog['image'])): ?>
            <img src="../<?= htmlspecialchars($blog['image']) ?>" alt="Blog Image" class="blog-image">
        <?php endif; ?>

        <div class="content">
            <?= nl2br(htmlspecialchars($blog['content'])) ?>
        </div>

        <a href="/personal-blog-system-project/dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
    </div>

</body>
</html>
