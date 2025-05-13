<?php
session_start();
include('db.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginn.html"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $adoption_status = $_POST['adoption_status'];

    $stmt = $conn->prepare("INSERT INTO pets (name, breed, age, adoption_status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $breed, $age, $adoption_status);
    $stmt->execute();
    $stmt->close();

    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add a New Pet</h1>
        <form method="POST" action="add_pet.php">
            <input type="text" name="name" placeholder="Pet Name" required>
            <input type="text" name="breed" placeholder="Breed" required>
            <input type="number" name="age" placeholder="Age" required>
            <select name="adoption_status" required>
                <option value="adopted">Adopted</option>
                <option value="available">Available</option>
            </select>
            <button type="submit">Add Pet</button>
        </form>
    </div>
</body>
</html>