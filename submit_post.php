<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $user_id = $_SESSION['user_id'];
    $caption = $_POST['caption'];
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image'];

        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_folder = 'uploads/' . $image_name;
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $image_type = mime_content_type($image_tmp);
        if (!in_array($image_type, $allowed_types)) {
            echo "Invalid image type!";
            exit();
        }
        move_uploaded_file($image_tmp, $image_folder);
    } else {
        echo "Error with image upload!";
        exit();
    } 
    if (empty($caption)) {
        echo "Caption is required!";
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO tab_post (user_id, caption, image_url) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $caption, $image_folder);
    $stmt->execute();
    $stmt->close();

    header("Location: petsagram.php"); 
    exit();
}
?>
