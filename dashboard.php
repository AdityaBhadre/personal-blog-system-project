<?php 
require("./auth/auth_check.php");

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   $user_name = $_SESSION['user_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <h2>Welcome, <?php echo $user_name;?>!</h2>
        <p>See all Posts-> <a href="/personal-blog-system-project/blog/view.php">Post</a></p><br><br>
        <a href="./auth/login.php">Logout</a>
    </div>
</body>
</html>