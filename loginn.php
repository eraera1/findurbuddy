<?php

include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];  
    $password = $_POST['password']; 

   
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: dashboard_user.php');
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='loginn.html';</script>";
        }
    } else {
        echo "<script>alert('Email not found.'); window.location.href='loginn.html';</script>";
    }
}
?>
