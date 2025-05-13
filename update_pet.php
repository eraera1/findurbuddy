<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  header("Location: admin_dashboard.php");
  exit();
}

$id = intval($_GET['id']); 
$sql = "SELECT * FROM pets WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$pet = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $breed = $_POST['breed'];
  $image = $_FILES['image']['name'];

 
  if (!empty($image)) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . basename($image);

    if (move_uploaded_file($imageTmp, $imagePath)) {
      $sql = "UPDATE pets SET name=?, age=?, breed=?, image=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssi", $name, $age, $breed, $image, $id);
    } else {
      echo "Error uploading image.";
      exit();
    }
  } else {
    
    $sql = "UPDATE pets SET name=?, age=?, breed=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $age, $breed, $id);
  }

  if ($stmt->execute()) {
    header("Location: admin_dashboard.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Pet</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fff0f5;
      padding: 2rem;
    }
    .form-container {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    input, select, button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 10px;
      border: 1px solid #ffcce0;
    }
    button {
      background: #ff5e87;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      font-size: 1rem;
      transition: 0.3s;
    }
    button:hover {
      background: #ff2d6b;
    }
    h2 {
      text-align: center;
      color: #ff5e87;
    }
    .image-preview {
      width: 100%;
      max-width: 200px;
      margin: 10px auto;
      display: block;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Update Pet</h2>
    <form action="update_pet.php?id=<?php echo $pet['id']; ?>" method="POST" enctype="multipart/form-data">
      <input type="text" name="name" value="<?= htmlspecialchars($pet['name']) ?>" required>
      <input type="number" name="age" value="<?= $pet['age'] ?>" required>
      <input type="text" name="breed" value="<?= htmlspecialchars($pet['breed']) ?>" required>
      <input type="file" name="image" accept="image/*">
      <img src="images/<?php echo $pet['image']; ?>" alt="Current Pet Image" class="image-preview">

      <button type="submit">Save Changes</button>
    </form>
  </div>
</body>
</html>
