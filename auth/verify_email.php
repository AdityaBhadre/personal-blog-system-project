<?php
require '../config/db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("UPDATE users SET `is_verified` = 1, `verification_token` = NULL WHERE `verification_token` = '$token'");

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        echo "✅ Email verified successfully!";
    } else {
        echo "❌ Invalid or expired token.";
    }
} else {
    echo "⚠️ No token provided.";
}
?>