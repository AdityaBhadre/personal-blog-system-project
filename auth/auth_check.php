<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please Login!!"; 
    header("Location: /personal-blog-system-project/auth/login.php");
    exit();
}
