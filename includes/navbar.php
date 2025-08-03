<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<nav style="background: #333; padding: 1rem; color: #fff;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <a href="/personal-blog-system-project/index.php" style="color: white; text-decoration: none; font-weight: bold;">
                📝 Blog System
            </a>
        </div>

        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="margin-right: 15px;">👤 <?= htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                <a href="/personal-blog-system-project/blog/create_blog.php" style="color: white; margin-right: 10px;">New Blog</a>
                <a href="/personal-blog-system-project/auth/logout.php" style="color: white;">Logout</a>
            <?php else: ?>
                <a href="/personal-blog-system-project/auth/login.php" style="color: white; margin-right: 10px;">Login</a>
                <a href="/personal-blog-system-project/auth/registration.php" style="color: white;">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
