<?php
session_start();

    

require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $adopted_status = isset($_POST['adopted_status']) ? 1 : 0;
    $image = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . $image;

    if (move_uploaded_file($imageTmp, $imagePath)) {
        try {
            $stmt = $conn->prepare("INSERT INTO pets (name, breed, age, adopted_status, image) VALUES (:name, :breed, :age, :adopted_status, :image)");
            $stmt->execute([
                ':name' => $name,
                ':breed' => $breed,
                ':age' => $age,
                ':adopted_status' => $adopted_status,
                ':image' => $image
            ]);
            echo "New pet added successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
