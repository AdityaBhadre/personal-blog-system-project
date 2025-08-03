<?php 
require("../auth/auth_check.php");

require ("../config/db.php");

// if(isset($_SESSION['user_id'])){
//     header('Location: ../auth/login.php');
//     exit();
// }

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];
    $imagePath = null;

    if(empty($title) || empty($content)){
        $error = 'Title and Content are required';
    }else{
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetDir = '../assets/uploads/';
            $targetPath = $targetDir . $imageName ;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)){
                $imagePath = 'assets/uploads/' . $imageName ;
            }else{
                $error ='Failed to upload image.';
            }
        }
        if($error === ''){
            $stmt = $conn->prepare("INSERT INTO blogs (`user_id`, `title`, `content`, `image`) VALUES ('$user_id', '$title', '$content', '$imagePath')");
            
            if($stmt->execute()){
                $success = '✅ Blog posted successfully!';
            }else{
                $error = '❌ Failed to post blog.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <link rel="stylesheet" href="../assets/css/create-blog.css">
</head>
<body>
    <h2>Create Blog Post</h2>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green"><?= $success ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Blog Title" required /><br><br>
        <textarea name="content" placeholder="Your blog content..." rows="5" required></textarea><br><br>
        <input type="file" name="image" accept="image/*"><br><br>
        <button type="submit">Publish</button>
    </form>

    <p><a href="/personal-blog-system-project/dashboard.php">⬅ Back to Dashboard</a></p>
</body>
</html>