<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Pet Manager</title>
  <link rel="stylesheet" href="styleadm.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #fff5f9;
      margin: 0;
      padding: 0;
      color: #333;
    }

    header {
      background-color: #ff5e87;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    header h1 {
      font-size: 1.6rem;
    }

    .admin-container {
      max-width: 1000px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #ffe3eb;
      color: #ff4f7c;
      font-weight: 600;
    }

    tr:hover {
      background-color: #fff0f5;
    }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.9rem;
    }

    .btn-update {
      background-color: #ffd1dc;
      color: #000;
    }

    .btn-delete {
      background-color: #ff7b9c;
      color: white;
    }

    .btn-add {
      margin-top: 1rem;
      background-color: #ff5e87;
      color: white;
      font-size: 1rem;
      padding: 10px 20px;
      border-radius: 10px;
      transition: background 0.3s;
    }

    .btn-add:hover {
      background-color: #ff3e6b;
    }

    .form-inline {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 1rem;
    }

    .form-inline input, .form-inline select {
      padding: 8px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 0.95rem;
    }

    @media(max-width: 768px) {
      .form-inline {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Admin Dashboard</h1>
    <a href="logoutt.php" style="color:white; text-decoration:underline;">Logout</a>
  </header>

  <div class="admin-container">
    <h2>Manage Pets</h2>

    <form class="form-inline" method="POST" action="add_pet.php">
      <input type="text" name="name" placeholder="Pet Name" required>
      <input type="text" name="breed" placeholder="Breed" required>
      <input type="number" name="age" placeholder="Age" required>
      <select name="adoption_status">
        <option value="available">Available</option>
        <option value="adopted">Adopted</option>
      </select>
      <button class="btn btn-add" type="submit">Add Pet</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Breed</th>
          <th>Age</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
         require_once 'db_config.php';

         try {
             $stmt = $conn->query("SELECT * FROM pets");
             $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
             foreach ($pets as $row) {
                 echo "<tr>";
                 echo "<td>{$row['name']}</td>";
                 echo "<td>{$row['breed']}</td>";
                 echo "<td>{$row['age']}</td>";
                 echo "<td>" . ($row['adoption_status'] == 1 ? 'Adopted' : 'Available') . "</td>";
                 echo "<td>
                         <a class='btn btn-update' href='update_pet.php?id={$row['id']}'>Update</a>
                         <a class='btn btn-delete' href='delete_pet.php?id={$row['id']}' onclick='return confirm(\"Delete this pet?\")'>Delete</a>
                       </td>";
                 echo "</tr>";
             }
         } catch (PDOException $e) {
             echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
         }
         
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['breed']}</td>";
            echo "<td>{$row['age']}</td>";
            echo "<td>{$row['adoption_status']}</td>";
            echo "<td>
                    <a class='btn btn-update' href='update_pet.php'?id={$row['id']}>Update</a>
                    <a class='btn btn-delete' href='delete_pet.php'?id={$row['id']}' onclick='return confirm(\"Delete this pet?\")'>Delete</a>
                  </td>";
            echo "</tr>";
          
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
