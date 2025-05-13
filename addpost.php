<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
    $user_id = $_SESSION['user_id']; 
    $pet_name = $_POST['pet_name'];
    $image_url = $_POST['image_url'];
    $caption = $_POST['caption'];

    $stmt = $conn->prepare("INSERT INTO posts (user_id, pet_name, image_url, caption) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $pet_name, $image_url, $caption);
    $stmt->execute();
    $stmt->close();

    header("Location: petsagram.php"); 
    exit();
}
?>
