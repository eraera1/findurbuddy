<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: loginn.html"); 
    exit();
}

$query = "SELECT * FROM pets";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Available Pets</h1>
        <?php while($pet = $result->fetch_assoc()): ?>
            <div class="pet-card">
                <p>Name: <?= $pet['name']; ?></p>
                <p>Breed: <?= $pet['breed']; ?></p>
                <p>Age: <?= $pet['age']; ?></p>
                <p>Status: <?= $pet['adoption_status']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>