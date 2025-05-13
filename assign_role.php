<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

if (isset($_GET['id']) && isset($_GET['role'])) {
    $user_id = $_GET['id'];
    $new_role = $_GET['role'];

    if ($new_role !== 'admin') {
        echo "<script>alert('Invalid role.'); window.location.href='admin_panel.php';</script>";
        exit();
    }

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $new_role, $user_id);
    if ($stmt->execute()) {
        echo "<script>alert('User role updated to admin successfully!'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error updating user role.'); window.location.href='admin_panel.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='admin_panel.php';</script>";
}
?>
