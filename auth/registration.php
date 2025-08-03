<?php 
    require ("../config/db.php");
    require ("../config/mail_config.php");
    
    session_start();
    
    if(isset($_POST["name"]) && $_POST['register-button']=="register"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $token = bin2hex(random_bytes(16));
        $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
        $register = $conn->prepare("INSERT INTO users (`name`, `email`, `password`, `verification_token`)
        VALUES ('$name', '$email', '$hashedPassword', '$token')");
        $result = $register->execute();
        if($result){
            $_SESSION['success'] = "Registered Succesfully!!, Please Verify Your Email";
            sendVerificationEmail($email, $token);
        }else{
            $$_SESSION['error'] = "An Error occured while registering";
        }
        header("Location: registration.php");
        exit();
    }
    $success = $_SESSION['success'] ?? '';
    $error = $_SESSION['error'] ?? '';
    unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
    <?php if (!empty($success)): ?>
    <div id="suc_mess">
        <?= $success ?>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div id="err_mess">
        <?= $error ?>
    </div>
<?php endif; ?>
    <form action="" method="post">
        Name <input type="text" name="name" placeholder="Enter your name" required><br>
        Email <input type="text" name="email" placeholder="Enter your email" required><br>
        Password <input type="password" name="password" placeholder="Enter your password" required><br><br>
        <button name="register-button" value="register">Submit</button>
    </form>
</body>
</html>