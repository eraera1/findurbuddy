<?php
session_start();
require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

   
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        
        $_SESSION['error'] = "Email is already registered!";
        header("Location: signupp.php");
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

   
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
        
        $_SESSION['success'] = "Account created successfully! Please log in.";
        header("Location: loginn.php");
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: signupp.php");
        exit();
    }
}
?>
