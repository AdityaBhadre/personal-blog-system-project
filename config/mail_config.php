<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/Exception.php';
require '../vendor/PHPMailer/PHPMailer.php';
require '../vendor/PHPMailer/SMTP.php';

function sendVerificationEmail($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
<<<<<<< HEAD
        $mail->Username   = 'adityabhadre18@gmail.com';      // your Gmail
=======
        $mail->Username   = '';      // your Gmail
>>>>>>> d1bf7d41040343e409afb5403441090fa40c06de
        $mail->Password   = '';         // your App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'MyPHPBlog');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email';
        $mail->Body    = "
            <h4>Thank you for registering!</h4>
            <p>Click the link below to verify your email:</p>
            <a href='http://localhost/personal-blog-system-project/auth/verify_email.php?token= <?php echo $token;?>'>Verify Email</a>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
