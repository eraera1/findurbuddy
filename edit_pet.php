<?php
session_start();
require_once 'db_config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: random project.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}


$id = intval($_GET['id']);
$sql = "SELECT * FROM pets WHERE id = $id";
$result = mysqli_query($conn, $sql);
$pet = mysqli_fetch_assoc($result);


if (!$pet) {
    header("Location: admin_dashboard.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $image = $_POST['image'];
    $adopted_status = isset($_POST['adopted']) ? 1 : 0;


    $sql = "UPDATE pets SET name = '$name', age = '$age', breed = '$breed', image = '$image', adopted = $adopted_status WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff0f5;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #ff5e87;
            margin-bottom: 30px;
        }
        .form-container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #ffb6c1;
            font-size: 16px;
        }
        button {
            width: 100%;
            background-color: #ff5e87;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
        }
        button:hover {
            background-color: #ff2d6b;
        }
        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: inline-block;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Edit Pet</h1>

    <div class="form-container">
        <form action="edit_pet.php?id=<?= $pet['id'] ?>" method="POST">
            <input type="text" name="name" value="<?= htmlspecialchars($pet['name']) ?>" placeholder="Pet Name" required>
            <input type="text" name="breed" value="<?= htmlspecialchars($pet['breed']) ?>" placeholder="Breed" required>
            <input type="number" name="age" value="<?= $pet['age'] ?>" placeholder="Age" required>
            <input type="text" name="image" value="<?= htmlspecialchars($pet['image']) ?>" placeholder="Image URL" required>

            <label>
                <input type="checkbox" name="adopted" <?= $pet['adopted'] == 1 ? 'checked' : '' ?>>
                Adopted
            </label>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
