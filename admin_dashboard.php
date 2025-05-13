<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM pets";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styleadm.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff0f5;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #ff5e87;
            margin-bottom: 30px;
        }
        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .pet-card {
            background: white;
            padding: 15px;
            margin: 10px;
            width: 300px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s;
        }
        .pet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        .pet-card img {
            width: 100%;
            border-radius: 8px;
        }
        .pet-details {
            margin: 10px 0;
        }
        .pet-details p {
            font-size: 1.1rem;
            color: #333;
        }
        .pet-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .pet-actions button {
            background: #ff5e87;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s;
        }
        .pet-actions button:hover {
            background: #ff2d6b;
        }
        .add-pet-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            background: #ff5e87;
            color: white;
            padding: 12px 0;
            text-align: center;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
        }
        .add-pet-btn:hover {
            background: #ff2d6b;
        }
    </style>
</head>
<body>

    <h2>Admin Dashboard</h2>

    <div class="dashboard-container">
        <a href="add_pet.php" class="add-pet-btn">Add New Pet</a>
        
        <?php foreach ($result as $pet) { ?>
            <div class="pet-card">
                <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="Pet Image">
                <div class="pet-details">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($pet['name']); ?></p>
                    <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
                    <p><strong>Age:</strong> <?php echo $pet['age']; ?> years old</p>
                    <p><strong>Status:</strong> <?php echo $pet['adopted_status'] ? 'Adopted' : 'Available'; ?></p>
                </div>
                <div class="pet-actions">
                    <a href="update_pet.php?id=<?php echo $pet['id']; ?>">
                        <button>Update</button>
                    </a>
                    <a href="delete_pet.php?id=<?php echo $pet['id']; ?>" onclick="return confirm('Are you sure you want to delete this pet?')">
                        <button>Delete</button>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>

</body>
</html>

