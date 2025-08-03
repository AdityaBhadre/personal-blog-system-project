<?php
require '../config/db.php';

$error = "";
$success = "";
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("UPDATE users SET `is_verified` = 1, `verification_token` = NULL WHERE `verification_token` = '$token'");

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $succes = "✅ Email verified successfully! Please Log in.";
    } else {
        $error = "❌ Invalid or expired token.";
    }
} else {
    $error = "⚠️ No token provided.";
}

header("referesh:5;url: login.php");
?>