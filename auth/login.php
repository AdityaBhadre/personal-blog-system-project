<?php 
session_start();
require ("../config/db.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    try {
        $verify = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $verify->bindParam(':email', $email);
        $verify->execute();
        $user = $verify->fetch(PDO::FETCH_ASSOC); 

        if ($user) {
            $userPassword = $user["password"];
            $isVerified = $user["is_verified"];

            if (password_verify($password, $userPassword)) {
                if ($isVerified == 1) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header('Location: /personal-blog-system-project/dashboard.php'); 
                    exit();
                } else {
                    $error = '⚠️ Please verify your email before logging in.';
                }
            } else {
                $error = '❌ Invalid email or password.';
            }
        } else {
            $error = '❌ User not found.';
        }

    } catch (Exception $e) {
        $error = "Server error: " . $e->getMessage(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        Email ID <input type="text" name="email" placeholder="Enter registered email"><br><br>
        Password <input type="password" name="password" placeholder="Enter your password"><br><br>
        <button name="login-button" value="login">Login</button>
        <p>Don't have an account? <a href="./registration.php">Register</a></p>
    </form>
</body>
</html>