<?php 
    require ("../config/db.php");
    require ("../config/mail_config.php");


    if(isset($_POST["name"]) && $_POST['register-button']=="register"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $token = bin2hex(random_bytes(16));
        $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
        $register = $conn->prepare("INSERT INTO users (`name`, `email`, `password`, `verification_token`)
        VALUES ('$name', '$email', '$password', '$token')");
        $result = $register->execute();
        if($result){
            echo "Registered Succesfully";
            sendVerificationEmail($email, $token);
        }else{
            echo "An Error occured while registering";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <form action="" method="post">
        Name <input type="text" name="name" placeholder="Enter your name" required><br>
        Email <input type="text" name="email" placeholder="Enter your email" required><br>
        Password <input type="password" name="password" placeholder="Enter your password" required><br><br>
        <button name="register-button" value="register">Submit</button>
    </form>
</body>
</html>