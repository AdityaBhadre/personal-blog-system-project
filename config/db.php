<?php 
$host = "localhost";
$username = "root";
$password = null;
$database = "personal_blog";

$conn = new PDO("mysql:host=$host;dbname=personal_blog", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>