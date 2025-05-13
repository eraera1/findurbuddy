<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];  
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];  


    $check = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $check->bindParam(':email', $email, PDO::PARAM_STR);
    $check->execute();

    if ($check->rowCount() > 0) {
  
        echo "<script>alert('Email already registered.'); window.location.href='signupp.html';</script>";
    } else {
       
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        if ($stmt->execute()) {
        
            echo "<script>alert('Signed up successfully!'); window.location.href='loginn.html';</script>";
        } else {
        
            echo "<script>alert('There was an error. Please try again.'); window.location.href='signupp.html';</script>";
        }
    }
}
?>
