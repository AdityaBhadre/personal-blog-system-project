<?php
require_once 'config/db.php'; 
require("./auth/auth_check.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Personal Blog System</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>!</h2>

        <p><a href="blog/create_blog.php">➕ Create New Blog</a></p>

        <h3>Your Blogs</h3>
        <ul>
            <?php
            $stmt = $conn->prepare("SELECT * FROM blogs WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->execute([$_SESSION['user_id']]);
            $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($blogs):
                foreach ($blogs as $blog):
            ?>
                <li>
                    <strong><?= htmlspecialchars($blog['title']); ?></strong><br>
                    <?= substr(htmlspecialchars($blog['content']), 0, 100); ?>...
                    <a href="blog/view.php?id=<?= $blog['id']; ?>">Read More</a>
                </li>
            <?php endforeach; else: ?>
                <p>You haven't written any blogs yet.</p>
            <?php endif; ?>
        </ul>

    <?php else: ?>
        <h1>Welcome to My Personal Blog System</h1>
        <p>Login or register to share your thoughts with the world.</p>
        <a href="auth/login.php">Login</a> | 
        <a href="auth/registration.php">Register</a>
    <?php endif; ?>
</div>

</body>
</html>
