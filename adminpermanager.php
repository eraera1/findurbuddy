<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header("Location: loginn.php");
  exit();
}

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'findurbuddy';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $breed = $_POST['breed'];
  $status = $_POST['status'];
  $image = $_POST['image'];

  $stmt = $conn->prepare("INSERT INTO pets (name, age, breed, adopted, image) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sisss", $name, $age, $breed, $status, $image);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_dashboard.php");
  exit();
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $stmt = $conn->prepare("DELETE FROM pets WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_dashboard.php");
  exit();
}

$pets = $conn->query("SELECT * FROM pets");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Pet Manager</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 20px;
      text-align: center;
    }
    h1 {
      color: #ff5e87;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #ffffff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ffcce0;
    }
    th {
      background-color: #ffeef4;
      color: #ff5e87;
    }
    form input, select {
      padding: 8px;
      margin: 5px;
      border-radius: 10px;
      border: 1px solid #ffb6c1;
    }
    .btn {
      background: #ff5e87;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s ease;
    }
    .btn:hover {
      background: #ff2d6b;
    }
    .image-preview {
      width: 60px;
      height: 60px;
      border-radius: 10px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <h1>Pet Management Dashboard</h1>

  <form method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <input type="number" name="age" placeholder="Age" required>
    <input type="text" name="breed" placeholder="Breed" required>
    <select name="status">
      <option value="no">Available</option>
      <option value="yes">Adopted</option>
    </select>
    <input type="text" name="image" placeholder="Image URL">
    <button type="submit" name="add" class="btn">Add Pet</button>
  </form>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Breed</th>
      <th>Adopted</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
    <?php while ($pet = $pets->fetch_assoc()): ?>
      <tr>
        <td><?= $pet['id'] ?></td>
        <td><?= htmlspecialchars($pet['name']) ?></td>
        <td><?= $pet['age'] ?></td>
        <td><?= htmlspecialchars($pet['breed']) ?></td>
        <td><?= $pet['adopted'] ?></td>
        <td><img src="<?= $pet['image'] ?>" class="image-preview"></td>
        <td><a href="?delete=<?= $pet['id'] ?>" class="btn">Delete</a></td>
      </tr>
      <?php endwhile; ?>
  </table>
</body>
</html>
